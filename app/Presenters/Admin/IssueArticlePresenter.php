<?php

namespace App\Presenters\Admin;

use App\Presenters\BasePresenter;

class IssueArticlePresenter extends BasePresenter
{

    public function shortTitle()
    {
        return $this->entity->short_title_display ?? $this->entity->title_display ?? $this->entity->title;
    }

    public function date()
    {
        if ($this->entity->date) {
            return $this->entity->date->format('M j, Y');
        }
    }

    public function issueNumber()
    {
        if ($this->entity->issue) {
            return $this->entity->issue->issue_number;
        }
    }

    public function issueTitle()
    {
        if ($this->entity->issue) {
            return $this->entity->issue->title_display ?? $this->entity->issue->title;
        }
    }

    public function listDescription() {
        return strip_tags($this->entity->list_description, '<i>');
    }
}
