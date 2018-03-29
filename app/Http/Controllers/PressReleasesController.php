<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\PressReleaseRepository;
use App\Models\PressRelease;

class PressReleasesController extends FrontController
{

    protected $repository;

    public function __construct(PressReleaseRepository $repository)
    {
        $this->repository = $repository;

        parent::__construct();
    }

    public function index(Request $request)
    {
        $items = PressRelease::published()->paginate();
        $navs = [
            'nav' => [
                ['label' => 'Press Releases', 'href' => '/press', 'active' => true],
            ],
            'subNav' => []
        ];
        $crumbs = [
            ['label' => 'About', 'href' => '/about'],
            ['label' => 'Press Releases', 'href' => '/about/press']
        ];

        $filters = array(
            array(
                'prompt' => 'Year',
                'links' => array(
                    array('href' => '#', 'label' => 'All', 'active' => true),
                ),
            ),
        );

        $view_data = [
            'title' => 'Press Releases',
            'subNav' => $navs['subNav'],
            'nav' => $navs['nav'],
            "breadcrumb" => $crumbs,
            'wideBody' => true,
            'filters' => $filters,
            'listingCountText' => 'Showing '.$items->total().' press releases',
            'listingItems' => $items,
        ];


        return view('site.pressreleases.index', $view_data);
    }

    public function show($id)
    {
        $page = $this->repository->find((Integer) $id);

        $navs = [
            'nav' => [
                ['label' => 'Press Releases', 'href' => '/press', 'active' => true],
            ],
            'subNav' => []
        ];
        $crumbs = [
            ['label' => 'About', 'href' => '/about'],
            ['label' => 'Press Releases', 'href' => '/about/press'],
            ['label' => $page->title, 'href' => '']
        ];

        return view('site.pressreleases.show', [
            'subNav' => $navs['subNav'],
            'nav' => $navs['nav'],
            'intro' => $page->short_description,
            'headerImage' => $page->imageFront('banner'),
            "title" => $page->title,
            "breadcrumb" => $crumbs,
            "blocks" => null,
            'featuredRelated' => [],
            'nav' => $navs['nav'],
            'page' => $page,
        ]);

    }

}
