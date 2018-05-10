<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Repositories\Api\ArtworkRepository;
use App\Repositories\Api\ExhibitionRepository;
use Carbon\Carbon;

class HomeController extends FrontController
{

    protected $shopItemRepository;
    protected $exhibitionRepository;

    public function __construct(ExhibitionRepository $exhibitionRepository, ArtworkRepository $artworkRepository)
    {
        $this->exhibitionRepository = $exhibitionRepository;
        $this->artworkRepository = $artworkRepository;

        parent::__construct();
    }

    public function index()
    {
        $this->seo->setTitle("Downtown Chicago's #1 Museum");
        $this->seo->setDescription("Located downtown by Millennium Park, this top art museum is TripAdvisor's #1 Chicago attraction—a must when visiting the city.");

        $page = Page::where('type', 0)->first();

        $exhibitions = $page->apiModels('homeExhibitions', 'Exhibition');
        $events = $page->homeEvents;

        $products = $page->apiModels('homeShopItems', 'ShopItem');

        $mainFeatures = collect([]);
        $mainFeatureBucket = $page->homeFeatures;
        foreach ($mainFeatureBucket as $feature) {
            $item = null;
            if ($feature->published) {
                if ($feature->events->count()) {
                    $item = $feature->events()->first();
                    $item->type = 'event';
                    $item->dateStart = Carbon::now();
                    $item->dateEnd = Carbon::now();
                    $item->feature_image = $feature->imageFront('hero');

                    $video_url = $feature->file('video');
                    if ($video_url != null) {
                        $poster_url = isset($item->feature_image['src']) ? $item->feature_image['src'] : '';
                        $video = [
                            'src' => $video_url,
                            'poster' => $poster_url,
                        ];
                        $item->videoFront = $video;
                    }

                } else if ($feature->exhibitions->count()) {
                    $item = $this->exhibitionRepository->getById($feature->exhibitions()->first()->datahub_id);
                    $item->feature_image = $feature->imageFront('hero');

                    $video_url = $feature->file('video');
                    if ($video_url != null) {
                        $poster_url = isset($item->feature_image['src']) ? $item->feature_image['src'] : '';
                        $video = [
                            'src' => $video_url,
                            'poster' => $poster_url,
                        ];
                        $item->videoFront = $video;
                    }

                    $item->type = 'exhibition';
                } else if ($feature->articles->count()) {
                    $item = $feature->articles()->first();
                    $item->type = 'article';
                    $item->dateStart = Carbon::now();
                    $item->dateEnd = Carbon::now();
                    $item->feature_image = $feature->imageFront('hero');

                    $video_url = $feature->file('video');
                    if ($video_url != null) {
                        $poster_url = isset($item->feature_image['src']) ? $item->feature_image['src'] : '';
                        $video = [
                            'src' => $video_url,
                            'poster' => $poster_url,
                        ];
                        $item->videoFront = $video;
                    }

                }

                if ($item) {
                    $mainFeatures[] = $item;
                }
            }
        }
        // TODO: sort by published or leave in position order?
        $mainFeatures = $mainFeatures->slice(0, 3);

        $collectionFeatures = collect([]);
        $collectionFeatureBucket = $page->collectionFeatures;
        foreach ($collectionFeatureBucket as $feature) {
            $item = null;
            if ($feature->published) {
                if ($feature->articles->count()) {
                    $item = $feature->articles()->first();
                    $item->type= 'article';
                    $item->subtype='Article';

                } else if ($feature->artworks->count()) {
                    $item = $this->artworkRepository->getById($feature->artworks()->first()->datahub_id);
                    $item->sku = "Artwork";
                    $item->type= 'artwork';
                     $item->subtype='Artwork';

                } else if ($feature->selections->count()) {
                    $item = $feature->selections()->first();

                    $item->type = 'selection';
                    $item->images = $item->getArtworkImages();
                    $item->subtype='Selection';
                }

                if ($item) {
                    $collectionFeatures[] = $item;
                }
            }
        }

        $membership_module_url = $page->home_membership_module_url;
        $membership_module_headline = $page->home_membership_module_headline;
        $membership_module_button_text = $page->home_membership_module_button_text;
        $membership_module_short_copy = $page->home_membership_module_short_copy;

        $view_data = [
            'contrastHeader' => sizeof($mainFeatures) > 0 ? true : false
            , 'filledLogo' => sizeof($mainFeatures) > 0 ? true : false
            , 'mainFeatures' => $mainFeatures
            , 'intro' => $page->home_intro
            , 'exhibitions' => $exhibitions
            , 'events' => $events
            , 'theCollection' => $collectionFeatures
            , 'products' => $products
            , 'membership_module_image' => $page->imageFront('home_membership_module_image')
            , 'membership_module_url' => $membership_module_url
            , 'membership_module_headline' => $membership_module_headline
            , 'membership_module_button_text' => $membership_module_button_text
            , 'membership_module_short_copy' => $membership_module_short_copy,
        ];

        return view('site.home', $view_data);
    }
}
