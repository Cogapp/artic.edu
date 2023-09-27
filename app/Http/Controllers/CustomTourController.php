<?php

namespace App\Http\Controllers;

use App\Models\CustomTour;
use Illuminate\Http\Request;

class CustomTourController extends Controller
{
    public function store(Request $request)
    {
//        $data = $request->validate([
//            'tour_json.title' => 'required|string',
//            'tour_json.description' => 'required|string',
//            'tour_json.artworks' => 'required|array'
//        ]);

        $tour = new CustomTour();
        $tour->tour_json = json_encode([
            'title' => 'Another custom Tour (Source)',
            'description' => 'Another custom tour description',
            'artworks' => ['artwork_url_1', 'artwork_url_2'],
        ]);

//        $tour->tour_json = $request['tour_json'];


        $tour->save();

//
      return response()->json(['message' => 'Tour created successfully!', 'tour' => $tour], 201);
    }

    public function show($id)
    {
        $tour = CustomTour::find($id);
        return view('site.tour', ['tour' => $tour]);
    }

    public function build()
    {
        return view('site.tour-builder');
    }
}
