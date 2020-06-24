<?php

namespace App\Presenters\Admin;

use App\Presenters\BasePresenter;

class ArticlePresenter extends BasePresenter
{
    public function titleInBucket()
    {
        if ($this->entity->title) {
            return $this->entity->title;
        }

        return 'No title';
    }

    public function date()
    {
        if ($this->entity->date) {
            return $this->entity->date->format('M j, Y');
        }
    }

    public function headerType()
    {
        switch ($this->entity->layout_type) {
            case \App\Models\Article::LARGE:
                return "feature";
                break;
            default:
                return null;
                break;
        }
    }

    public function url()
    {
        return route('articles.show', $this->entity);
    }

    public function author()
    {
        if ($this->entity->authors->isNotEmpty()) {
            $array = $this->entity->authors->pluck('title')->all();
            return join(' and ', array_filter(array_merge(array(join(', ', array_slice($array, 0, -1))), array_slice($array, -1)), 'strlen'));
        }
        return $this->entity->author_display;
    }
}
