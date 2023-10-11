<?php

namespace Tests\Feature;

use Aic\Hub\Foundation\Testing\FeatureTestCase as BaseTestCase;
use App\Models\Api\CustomTour;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\MockApi;

class CustomTourAPITest extends BaseTestCase
{
    use MockApi;
    use WithFaker;

    /**
     * A feature test to test the Custom Tours API POST and GET routes.
     */
    public function testCreateAndGetCustomTour()
    {

        $tourData = [
            "title" => "My tour title",
            "descriptions" => "My tour description",
            "artworks" => [
                [
                    "id" => 656,
                    "image_id" => "6b1edb9c-0f3f-0ee3-47c7-ca25c39ee360",
                    "title" => "Lion (One of a Pair, South Pedestal)",
                    "description" => "Object description",
                    "artist" => "Artist name",
                    "date" => "1888",
                    "gallery_title" => "Michigan Avenue entrance/steps",
                    "latitude" => null,
                    "longitude" => null,
                    "objectNote" => "note about the lion",
                ],
            ],
        ];

        $customTour = new CustomTour();
        $customTour->tour_json = $tourData;

//        $customTour = CustomTour::create(['tour_json' => json_encode($tourData)]);

//        $test = 1;

        $this->addMockApiResponses($this->mockApiModelReponse($customTour,201));

        $postResponse = $this->postJson(route('custom-tours-api.store'), $customTour->toArray());

        $test = route('custom-tours-api.store');


        // Check the response has a status code of 201
        $postResponse->assertStatus(201);

//        // Send a GET request to the custom tours API route, using the id of the newly created Custom Tour
//        $getResponse = $this->get(route('custom-tours-api.show', ['id' => 1]));
//
//        // Check the response has a status code of 200
//        $getResponse->assertStatus(200);

        // Check that the response JSON has the expected structure
//        $getResponse->assertJsonStructure([
//            'tour_json' => [
//                'title',
//                'description',
//                'artworks',
//            ],
//        ]);

        // Check that the response JSON has the expected 'title'
//        $getResponse->assertJsonFragment(['title' => 'Custom Tour']);


        // Check that the response JSON has the same number of artworks as the original $data
//        $getResponse->assertJsonCount(count($tourData['artworks']), 'tour_json.artworks');
    }

//    public function testCustomTourMissingTitleValidation()
//    {
//        // The JSON data to send to the API
//        // Intentionally missing "title"
//        $data = [
//            "description" => "Custom tour (optional) description",
//            "artworks" => [
//                [
//                    "id" => 730796,
//                    "title" => "Artwork one",
//                    "objectNote" => "A short note."
//                ],
//                [
//                    "id" => 243516,
//                    "title" => "Artwork two"
//                ],
//                [
//                    "id" => 21023,
//                    "title" => "Artwork three",
//                    "objectNote" => "Third artwork note"
//                ],
//                [
//                    "id" => 99539,
//                    "title" => "Artwork four"
//                ]
//            ]
//        ];
//
//        // Send a POST request to the custom tours API route
//        $postResponse = $this->json('POST', 'https://' . config('app.url') . '/api/v1/custom-tours', $data);
//
//        // Check that the response has a status code of 422
//        $postResponse->assertStatus(422);
//    }

//    public function testCustomTourMissingArtworksValidation()
//    {
//        // The JSON data to send to the API
//        // Intentionally missing "artworks"
//        $data = [
//            "title" => "Custom Tour",
//            "description" => "Custom tour (optional) description",
//        ];
//
//        // Send a POST request to the custom tours API route
//        $postResponse = $this->json('POST', 'https://' . config('app.url') . '/api/v1/custom-tours', $data);
//
//        // Check that the response has a status code of 422
//        $postResponse->assertStatus(422);
//    }

//    public function testCustomTourIncorrectTypeValidation()
//    {
//        // The JSON data to send to the API
//        // Intentionally has an array as the artworks.title (only accepts a string)
//        $data = [
//            "title" => "Custom Tour",
//            "description" => "Custom tour (optional) description",
//            "artworks" => [
//                [
//                    "id" => 730796,
//                    "title" => ["Artwork one", "Artwork two", "Artwork three", "Artwork four"],
//                    "objectNote" => "A short note about the artworks."
//                ],
//            ]
//        ];
//
//        // Send a POST request to the custom tours API route
//        $postResponse = $this->json('POST', 'https://' . config('app.url') . '/api/v1/custom-tours', $data);
//
//        // Check that the response has a status code of 422
//        $postResponse->assertStatus(422);
//    }
}
