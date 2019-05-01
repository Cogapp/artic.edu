<?php

namespace App\Libraries\Search\Filters;

class BaseFilteredList
{
    protected $buckets;
    protected $labels;
    protected $entity;

    protected $parameter;

    protected $activeList = false;

    protected $aggregationName;

    public function __construct($buckets, $aggregationName)
    {
        $this->buckets = collect($buckets);
        $this->aggregationName = $aggregationName;
    }

    public function generateFilteredCategory()
    {
        // Build options list and sort by selected (move selected at the beginning)
        $list = $this->buckets->map(function ($item) {
            // Get all ID's for the category
            $input = collect(explode(';', request()->input($this->parameter)));

            // If input contains the ID, remove it from the URL (uncheck link)
            if ($enabled = $input->contains($item->key)) {
                // If there's any selected element open the tab by default
                $this->activeList = true;
                $newInput = $input->forget($input->search($item->key))->filter();
            } else {
                $newInput = $input->push($item->key)->filter();
            }

            $extraParams = $newInput->isEmpty() ? [] : [$this->parameter => join(';', $newInput->toArray())];
            // Build the checkbox route using previously calculated inputs
            $route = route('collection', request()->except(['page', $this->parameter, 'categoryQuery']) + $extraParams);

            return [
                'href' => $route,
                'count' => $item->doc_count,
                'label' => $this->findLabel($item->key),
                'enabled' => $enabled
            ];
        })->sortByDesc('count');

        // TODO: Is this necessary to keep? Issues with size > 10 [WEB-968]
        // I figure the `enabled` items will always have the highest count.
        // })->sortByDesc('enabled'); // Move selected ones to the top

        return $list;
    }

    public function findLabel($id)
    {
        $label = $this->loadLabels()->get($id);
        return ucfirst($label);
    }

    public function loadLabels()
    {
        if ($this->labels)
            return $this->labels;

        // Get ID's from buckets
        $ids = $this->buckets->pluck('key')->toArray();

        // Load entities and build an array with ID => Title
        $this->labels = $this->entity::query()
            ->ids($ids)
            ->get(['id', 'title'])
            ->pluck('title','id');

        return $this->labels;
    }

}
