<?php

namespace App\Repositories;

use A17\CmsToolkit\Repositories\Behaviors\HandleSlugs;
use A17\CmsToolkit\Repositories\Behaviors\HandleMedias;
use A17\CmsToolkit\Repositories\ModuleRepository;
use App\Repositories\Behaviors\HandleApi;
use App\Models\Selection;

class SelectionRepository extends ModuleRepository
{
    use HandleSlugs, HandleMedias, HandleApi;

    public function __construct(Selection $model)
    {
        $this->model = $model;
    }

    public function afterSave($object, $fields)
    {
        $this->updateBrowserApiRelated($object, $fields, 'artworks');
        $this->updateBrowser($object, $fields, 'selections');

        parent::afterSave($object, $fields);
    }

    public function getFormFields($object)
    {
        $fields = parent::getFormFields($object);
        $fields = $this->getFormFieldsForMultiSelect($fields, 'site_tags', 'id');

        $fields['browsers']['artworks'] = $this->getFormFieldsForBrowserApi($object, 'artworks', 'App\Models\Api\Artwork', 'whatson');
        $fields['browsers']['selections'] = $this->getFormFieldsForBrowser($object, 'selections', 'whatson');

        return $fields;
    }

}
