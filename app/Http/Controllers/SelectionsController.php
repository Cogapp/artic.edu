<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\SelectionRepository;
use App\Models\Selection;
use App\Libraries\ExploreFurther\SelectionService as ExploreFurther;

use Illuminate\Support\Str;

class SelectionsController extends FrontController
{
    protected $repository;

    public function __construct(SelectionRepository $repository)
    {
        $this->repository = $repository;

        parent::__construct();
    }

    public function index(Request $request)
    {
        $items = $this->repository->published()->listed()->ordered()->paginate();
        $title = 'Highlights';

        $subNav = [
            ['label' => $title, 'href' => route('selections.index'), 'active' => true]
        ];

        $nav = [
            [ 'label' => 'The Collection', 'href' => route('collection'), 'links' => $subNav ]
        ];

        $this->seo->setTitle($title);

        $view_data = [
            'title'  => $title,
            'subNav' => $subNav,
            'nav'    => $nav,
            'wideBody' => true,
            'filters'    => null,
            'listingCountText' => 'Showing '.$items->total().' highlights',
            'listingItems' => $items,
        ];


        return view('site.genericPage.index', $view_data);
    }

    public function show($id, $slug = null)
    {
        $item = $this->repository->getById((Integer) $id);

        // Redirect to the canonical page if it wasn't requested
        $canonicalPath = route('selections.show', ['id' => $item->id, 'slug' => $item->getSlug()]);

        if (!Str::endsWith($canonicalPath, request()->path())) {
            return redirect($canonicalPath, 301);
        }

        $this->seo->setTitle($item->meta_title ?: $item->title);
        $this->seo->setDescription($item->meta_description ?: $item->short_copy);
        $this->seo->setImage($item->imageFront('hero'));

        $artworks = $item->artworks(0);
        $exploreFurther = new ExploreFurther($item, $artworks->getMetadata('aggregations'));

        $alsoInThisIssue = null;

        if ($item->is_unlisted) {
            $alsoInThisIssue = $this->repository->getAlsoInThisIssue($item) ?? null;
        }

        return view('site.selectionDetail', [
            'contrastHeader' => $item->present()->contrastHeader,
            'item' => $item,
            'exploreFurtherTags'    => $exploreFurther->tags(),
            'exploreFurther'        => $exploreFurther->collection(request()->all()),
            'exploreFurtherAllTags' => $exploreFurther->allTags(request()->all()),
            'exploreFurtherCollectionUrl' => $exploreFurther->collectionUrl(request()->all()),
            'alsoInThisIssue'       => $alsoInThisIssue ?? null,
            'canonicalUrl' => $canonicalPath,
        ]);
    }

}
