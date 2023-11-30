<?php

namespace App\Http\Controllers;

use App\Models\CustomTour;
use App\Libraries\CustomTour\ArtworkSortingService;

class CustomTourController extends FrontController
{
    public function show($id)
    {
        $customTourItem = CustomTour::find($id);

        if (!$customTourItem) {
            return abort(404);
        }

        $customTour = json_decode($customTourItem->tour_json, true);

        ArtworkSortingService::sortArtworksByGallery($customTour['artworks'], config('galleries.order'));

        $this->seo->setTitle($customTour['title']);

        if (array_key_exists('description', $customTour)) {
            $this->seo->setDescription($customTour['description']);
        }

        $this->seo->nofollow = true;
        $this->seo->noindex = true;

        // Calculate unique galleries and artists
        $galleryTitles = array_column($customTour['artworks'], 'gallery_title');
        $uniqueGalleryTitles = array_unique($galleryTitles);
        $uniqueGalleriesCount = count($uniqueGalleryTitles);

        $artistNames = array_column($customTour['artworks'], 'artist_title');
        $uniqueArtistNames = array_unique($artistNames);
        $uniqueArtistsCount = count($uniqueArtistNames);

        return view('site.customTour', [
            'id' => $customTourItem->id,
            'custom_tour' => $customTour,
            'unique_galleries_count' => $uniqueGalleriesCount,
            'unique_artists_count' => $uniqueArtistsCount,
            'unstickyHeader' => true,
        ]);
    }

    public function showCustomTourBuilder()
    {
        return view('site.customTourBuilder');
    }
}
