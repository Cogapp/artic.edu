<?php

namespace App\Http\Controllers;

use App\Repositories\Api\ExhibitionRepository;
use App\Repositories\GenericPageRepository;

class GenericPagesController extends FrontController
{
    protected $genericPageRepository;
    protected $exhibitionRepository;

    public function __construct(GenericPageRepository $genericPageRepository, ExhibitionRepository $exhibitionRepository)
    {
        $this->genericPageRepository = $genericPageRepository;
        $this->exhibitionRepository = $exhibitionRepository;
        parent::__construct();
    }

    public function show($slug)
    {
        $page       = $this->getPage($slug);
        $crumbs     = $page->present()->breadCrumb($page);
        $navigation = $page->present()->navigation();

        $this->seo->setTitle($page->meta_title ?: $page->title);
        $this->seo->setDescription($page->meta_description ?: $page->short_description);

        return view('site.genericPage.show', [
            'borderlessHeader' => !(empty($page->imageFront('banner'))),
            'nav' => $navigation,
            'intro' => $page->short_description,
            'headerImage' => $page->imageFront('banner'),
            "title" => $page->title,
            "breadcrumb" => $crumbs,
            "blocks" => null,
            'featuredRelated' => $page->featuredRelated,
            'page' => $page,
        ]);
    }

    protected function getPage($slug)
    {
        $parts = collect(explode("/", $slug));
        $page = $this->genericPageRepository->forSlug($parts->last());
        if (empty($page)) {
            $page = $this->genericPageRepository->getById((integer) $parts->last());
        }

        if (!$page) {
            abort(404);
        }

        return $page;
    }

}
