<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\PrintedPublicationRepository;
use App\Models\PrintedPublication;
use App\Models\CatalogCategory;

class PrintedPublicationsController extends BaseScopedController
{

    protected $repository;

    protected $entity = \App\Models\PrintedPublication::class;

    protected $scopes = [
        'category' => 'byCategory',
    ];

    public function __construct(PrintedPublicationRepository $repository)
    {
        $this->repository = $repository;

        parent::__construct();
    }

    protected function beginOfAssociationChain()
    {
        // Apply default scopes to the beginning of the chain
        return parent::beginOfAssociationChain()
            ->published();
    }

    public function index(Request $request)
    {
        $items = $this->collection()->ordered()->paginate();

        $title = 'Print Publications';

        $this->seo->setTitle($title);

        $navElements = get_nav_for_publications($title);

        $view_data = [
            'wideBody' => true,
            'filters' => $this->getFilters(),
            'listingCountText' => 'Showing '.$items->total().' print publications',
            'listingItems' => $items,
        ] + $navElements;


        return view('site.genericPage.index', $view_data);
    }

    public function show($id)
    {
        $page = $this->repository->safeForSlug($id);
        if (!$page) {
            $page = $this->repository->find((Integer) $id) ?? abort(404);
        }

        $this->seo->setTitle($page->meta_title ?: $page->title);
        $this->seo->setDescription($page->meta_description ?? $page->short_description ?? $page->listing_description);
        $this->seo->setImage($page->imageFront('listing'));

        $crumbs = [
            ['label' => 'The Collection', 'href' => route('collection')],
            ['label' => 'Print Publications', 'href' => route('collection.publications.printed-publications')],
            ['label' => $page->title, 'href' => '']
        ];

        return view('site.genericPage.show', [
            'borderlessHeader' => !(empty($page->imageFront('banner'))),
            'nav'    => null,
            'intro'  => $page->short_description,
            'headerImage' => $page->imageFront('banner'),
            "title" => $page->title,
            "breadcrumb" => $crumbs,
            'page' => $page,
        ]);

    }

    protected function getFilters()
    {

        $categoryLinks[] = [
            'label'  => 'All',
            'href'   => route('collection.publications.printed-publications'),
            'active' => empty(request('category', null))
        ];

        foreach (CatalogCategory::all() as $category) {
            $categoryLinks[] = [
                'href'   => route('collection.publications.printed-publications', request()->except('category') + ['category' => $category->id]),
                'label'  => $category->name,
                'active' => request('category') == $category->id
            ];
        }

        return [
            [
                'prompt' => 'Subject',
                'links'  => collect($categoryLinks)
            ]
        ];

    }

}
