<?php

namespace App\Models\Behaviors;

use App\Models\Article;
use App\Models\Selection;
use App\Models\Event;
use App\Models\Api\Exhibition;
use App\Models\Experience;
use App\Models\DigitalPublication;
use App\Models\Video;

use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

/**
 * WEB-1415: Requires HasApiRelations and HasRelations.
 */
trait HasFeaturedRelated
{
    private $targetItemCount = 6;

    private $selectedFeaturedRelateds;

    private $isFeaturedRelatedCurated = true;

    public function getFeaturedRelatedTitle()
    {
        return ($this->isFeaturedRelatedCurated ? 'Related' : 'Recent') . ' Content';
    }

    public function hasFeaturedRelated()
    {
        return !empty($this->getFeaturedRelated());
    }

    public function getFeaturedRelated()
    {
        if ($this->selectedFeaturedRelateds) {
            return $this->selectedFeaturedRelateds;
        }

        $relatedItems = $this->getCustomRelatedItems();

        if ($relatedItems->count() < 1) {
            $this->isFeaturedRelatedCurated = false;
        }

        if ($relatedItems->count() < $this->getTargetItemCount()) {
            $relatedItems = $relatedItems->merge($this->getDefaultRelatedItems());
            $relatedItems = $relatedItems->slice(0, $this->getTargetItemCount());
        }

        $this->selectedFeaturedRelateds = $this->getLabeledRelatedItems($relatedItems);

        return $this->selectedFeaturedRelateds;
    }

    /**
     * Public b/c API models needs to check if their augmented models have related content.
     */
    public function getCustomRelatedItems()
    {
        $relatedItems = $this->getRelatedWithApiModels('sidebar_items', [
            'exhibitions' => [
                'apiModel' => 'App\Models\Api\Exhibition',
                'routePrefix' => 'exhibitions_events',
                'moduleName' => 'exhibitions',
            ],
        ], [
            // See $typeUsesApi in HasApiRelations class
            'articles' => false,
            'selections' => false,
            'events' => false,
            'exhibitions' => true, // API!
            'experiences' => false,
            'digitalPublications' => false,
            'videos' => false,
        ]) ?? collect([]);

        return $this->getFilteredRelatedItems($relatedItems);
    }

    protected function getTargetItemCount()
    {
        return $this->targetItemCount;
    }

    protected function getFilteredRelatedItems($relatedItems)
    {

        $now = Carbon::now();

        return $relatedItems->filter(function($relatedItem) use ($now) {
            // TODO: Verify that we don't need to check if the exhibition is in the future?
            if (get_class($relatedItem) === \App\Models\Api\Exhibition::class) {
                return true;
            }

            if (get_class($relatedItem) === \App\Models\Api\Event::class) {
                if (!$relatedItem->isFuture) {
                    return false;
                }
            }

            $isPublished = isset($relatedItem->published) && $relatedItem->published;
            $isVisible = (
                !$relatedItem->isFillable('publish_start_date') ||
                !isset($relatedItem->publish_start_date) ||
                $relatedItem->publish_start_date < $now
            ) && (
                !$relatedItem->isFillable('publish_end_date') ||
                !isset($relatedItem->publish_end_date) ||
                $relatedItem->publish_end_date > $now
            );

            return $isPublished && $isVisible;
        })->values();
    }

    private function getDefaultRelatedPool()
    {
        $poolSize = 20;

        // Avoid accidentally seeding the pool with draft items during preview mode
        $oldPreviewMode = config('aic.is_preview_mode');
        config(['aic.is_preview_mode' => false]);

        // WEB-2018: Do we need to check published date, or is it ok to just keep checking updated_at?
        $articles = Article::published()->visible()->notUnlisted()->orderBy('updated_at', 'desc')->limit($poolSize)->get();
        $selections = Selection::published()->visible()->notUnlisted()->orderBy('updated_at', 'desc')->limit($poolSize)->get();
        $experiences = Experience::published()->visible()->notUnlisted()->orderBy('updated_at', 'desc')->limit($poolSize)->get();
        $videos = Video::published()->visible()->orderBy('updated_at', 'desc')->limit($poolSize)->get();

        config(['aic.is_preview_mode' => $oldPreviewMode]);

        return collect([])
            ->merge($articles)
            ->merge($selections)
            ->merge($experiences)
            ->merge($videos)
            ->filter(function($item) {
                return $item->imageFront('hero') !== null;
            })
            ->sortBy('updated_at')
            ->reverse()
            ->slice(0, $poolSize)
            ->values();
    }

    private function getDefaultRelatedItems()
    {
        $recentItems = $this->getDefaultRelatedPool();

        return $recentItems
            ->filter(function($item) {
                return get_class($item) !== get_class($this) || $item->id !== $this->id;
            })
            ->random($this->targetItemCount)
            ->values();
    }

    private function getLabeledRelatedItems($relatedItems)
    {
        $labeledRelatedItems = [];

        $relatedItems->each(function ($relatedItem) use (&$labeledRelatedItems) {
            switch (get_class($relatedItem)) {
                case Article::class:
                    // Tag is often "In the Lab", "Collection Spotlight", etc.
                    $label = 'Article';
                    $type = 'article';
                    break;
                case Selection::class:
                    $label = null;
                    $type = 'selection';
                    break;
                case Event::class:
                    // Tag is replaced by "Tour", "Member Exclusive", etc.
                    $label = 'Event';
                    $type = 'event';
                    break;
                case Exhibition::class:
                    // Tag is often "Closed", "Ongoing", "Closing soon", etc.
                    $label = 'Exhibition';
                    $type = 'exhibition';
                    break;
                case Experience::class:
                    // Tag is "Interactive Feature"
                    $label = null;
                    $type = 'experience';
                    break;
                case DigitalPublication::class:
                    // No tag
                    $label = 'Digital Publication';
                    $type = 'generic';
                    break;
                case Video::class:
                    // Tag is "Video"
                    $label = 'Media';
                    $type = 'media';
                    break;
                default:
                    throw new \Exception('Cannot determine sidebar item type');
                    break;
            }

            $labeledRelatedItems[] = [
                'label' => $label ?? 'Content',
                'type' => $type,
                'item' => $relatedItem,
            ];
        });

        return $labeledRelatedItems;
    }

}
