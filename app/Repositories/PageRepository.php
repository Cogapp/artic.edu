<?php

namespace App\Repositories;

use A17\CmsToolkit\Repositories\Behaviors\HandleMedias;
use A17\CmsToolkit\Repositories\Behaviors\HandleRepeaters;
use A17\CmsToolkit\Repositories\Behaviors\HandleRevisions;
use A17\CmsToolkit\Repositories\Behaviors\HandleSlugs;
use A17\CmsToolkit\Repositories\ModuleRepository;
use App\Models\Page;
use App\Repositories\Behaviors\HandleApiRelations;

class PageRepository extends ModuleRepository
{
    use HandleSlugs, HandleRevisions, HandleMedias, HandleRepeaters, HandleApiRelations;

    public function __construct(Page $model)
    {
        $this->model = $model;
    }

    public function hydrate($object, $fields)
    {
        $this->hydrateOrderedBelongsTomany($object, $fields, 'homeExhibitions', 'position', 'Exhibition');
        $this->hydrateOrderedBelongsTomany($object, $fields, 'homeEvents', 'position', 'Event');
        $this->hydrateOrderedBelongsTomany($object, $fields, 'homeFeatures', 'position', 'HomeFeature');
        $this->hydrateOrderedBelongsTomany($object, $fields, 'homeShopItems', 'position', 'ShopItem');
        return parent::hydrate($object, $fields);
    }

    public function afterSave($object, $fields)
    {
        // General
        $this->updateBrowserApiRelated($object, $fields, ['homeShopItems', 'homeExhibitions','exhibitionsExhibitions', 'exhibitionsCurrent']);

        // Homepage
        $this->updateBrowser($object, $fields, 'homeEvents');
        $this->updateBrowser($object, $fields, 'homeFeatures');

        // Visits
        $this->updateRepeater($object, $fields, 'admissions', 'Admission');
        $this->updateRepeater($object, $fields, 'locations', 'Location');

        // Articles
        $this->updateBrowser($object, $fields, 'articlesArticles');

        // Art & Ideas
        $this->updateBrowser($object, $fields, 'artArticles');

        parent::afterSave($object, $fields);
    }

    public function getFormFields($object)
    {
        $fields = parent::getFormFields($object);

        // Homepage
        $fields['browsers']['homeExhibitions'] = $this->getFormFieldsForBrowserApi($object, 'homeExhibitions', 'App\Models\Api\Exhibition', 'exhibitions_events', 'title', 'exhibitions');
        $fields['browsers']['homeEvents'] = $this->getFormFieldsForBrowser($object, 'homeEvents', 'exhibitions_events', 'title', 'events');
        $fields['browsers']['homeShopItems'] = $this->getFormFieldsForBrowserApi($object, 'homeShopItems', 'App\Models\Api\ShopItem', 'visit');
        $fields['browsers']['homeFeatures'] = $this->getFormFieldsForBrowser($object, 'homeFeatures', 'homepage', 'title', 'homeFeatures');

        // Exhibition & Events
        $fields['browsers']['exhibitionsExhibitions'] = $this->getFormFieldsForBrowserApi($object, 'exhibitionsExhibitions', 'App\Models\Api\Exhibition', 'exhibitions_events', 'title', 'exhibitions');
        $fields['browsers']['exhibitionsCurrent'] = $this->getFormFieldsForBrowserApi($object, 'exhibitionsCurrent', 'App\Models\Api\Exhibition', 'exhibitions_events', 'title', 'exhibitions');

        // Visits
        $fields = $this->getFormFieldsForRepeater($object, $fields, 'admissions', 'Admission');
        $fields = $this->getFormFieldsForRepeater($object, $fields, 'locations', 'Location');

        // Articles
        $fields['browsers']['articlesArticles'] = $this->getFormFieldsForBrowser($object, 'articlesArticles', 'collection.articles_publications', 'title', 'articles');

        // Art & Ideas
        $fields['browsers']['artArticles'] = $this->getFormFieldsForBrowser($object, 'artArticles', 'collection.articles_publications', 'title', 'articles');

        return $fields;
    }

    public function byName($name, $with = [])
    {
        $type = array_search($name, $this->model::$types);
        return $this->model->whereType($type)->with($with)->first();
    }
}
