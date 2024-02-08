<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomTour;
use App\Libraries\CustomTour\ArtworkSortingService;

class CustomTourController extends FrontController
{
    public function show(Request $request, $id)
    {
        $customTour = CustomTour::findOrFail($id);

        $customTourJson = $customTour->tour_json;

        ArtworkSortingService::sortArtworksByGallery($customTourJson['artworks'], config('galleries.order'));

        $this->seo->setTitle($customTourJson['title']);

        if (array_key_exists('description', $customTourJson)) {
            $this->seo->setDescription($customTourJson['description']);
        }

        $this->seo->image = 'https://' . rtrim(config('app.url'), '/') . '/iiif/2/3c27b499-af56-f0d5-93b5-a7f2f1ad5813/full/1200,799/0/default.jpg';
        $this->seo->width = 1200;
        $this->seo->height = 799;
        $this->seo->nofollow = true;
        $this->seo->noindex = true;

        // Calculate unique galleries and artists
        $galleryTitles = array_column($customTourJson['artworks'], 'gallery_title');
        $uniqueGalleryTitles = array_unique($galleryTitles);
        $uniqueGalleriesCount = count($uniqueGalleryTitles);

        $artistNames = array_column($customTourJson['artworks'], 'artist_title');
        $uniqueArtistNames = array_unique($artistNames);
        $uniqueArtistsCount = count($uniqueArtistNames);

        // Variable to check for tourCreationComplete=true in the URL
        $tourCreationComplete = $request->query('tourCreationComplete') === 'true';

        return view('site.customTour', [
            'id' => $customTour->id,
            'custom_tour' => $customTourJson,
            'unique_galleries_count' => $uniqueGalleriesCount,
            'unique_artists_count' => $uniqueArtistsCount,
            'unstickyHeader' => true,
            'tour_creation_completed' => $tourCreationComplete
        ]);
    }

    public function pdfLayout(Request $request, $id)
    {
        $customTour = CustomTour::findOrFail($id);

        $customTourJson = $customTour->tour_json;

        ArtworkSortingService::sortArtworksByGallery($customTourJson['artworks'], config('galleries.order'));

        // Calculate unique galleries and artists
        $galleryTitles = array_column($customTourJson['artworks'], 'gallery_title');
        $uniqueGalleryTitles = array_unique($galleryTitles);
        $uniqueGalleriesCount = count($uniqueGalleryTitles);

        $artistNames = array_column($customTourJson['artworks'], 'artist_title');
        $uniqueArtistNames = array_unique($artistNames);
        $uniqueArtistsCount = count($uniqueArtistNames);


        return view('site.customToursPdfLayout', [
            'id' => $customTour->id,
            'custom_tour' => $customTourJson,
            'unique_galleries_count' => $uniqueGalleriesCount,
            'unique_artists_count' => $uniqueArtistsCount,
        ]);
    }

    public function showCustomTourBuilder()
    {
        return view('site.customTourBuilder', [
            'unstickyHeader' => true
        ]);
    }
}
