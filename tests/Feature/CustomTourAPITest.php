<?php

namespace Tests\Feature;

use Aic\Hub\Foundation\Testing\FeatureTestCase as BaseTestCase;
use Illuminate\Support\Facades\Request;

class CustomTourAPITest extends BaseTestCase
{
    /**
     * A feature test to test the Custom Tours API POST and GET routes.
     */
    public function testCreateAndGetCustomTour()
    {
        // Todo: Update the API routes to dynamically use the app url
        // $currentUrl = Request::url();
        $currentUrl = 'https://artic.edu.ddev.site/';

        // The JSON data to send to the API
        $data = [
            "title" => "Custom Tour",
            "description" => "Custom tour (optional) description",
            "artworks" => [
                [
                    "id" => 730796,
                    "title" => "Artwork one",
                    "objectNote" => "A short note."
                ],
                [
                    "id" => 243516,
                    "title" => "Artwork two"
                ],
                [
                    "id" => 21023,
                    "title" => "Artwork three",
                    "objectNote" => "Third artwork note"
                ],
                [
                    "id" => 99539,
                    "title" => "Artwork four"
                ]
            ]
        ];

        // Send a POST request to the custom tours API route
        $postResponse = $this->json('POST', 'https://artic.edu.ddev.site/api/v1/custom-tours', $data);

        // Assert that the response has a status code of 201 (Created)
        $postResponse->assertStatus(201);

        // Send a GET request to the custom tours API route, using the id of the newly created Custom Tour
        $getResponse = $this->json('GET', 'https://artic.edu.ddev.site/api/v1/custom-tours/1');

        // Assert that the response has a status code of 200 (OK)
        $getResponse->assertStatus(200);

        // Assert that the response JSON has the expected structure
        $getResponse->assertJsonStructure([
            'tour_json' => [
                'title',
                'description',
                'artworks',
            ],
        ]);

        // Assert that the response JSON has the expected 'title'
        $getResponse->assertJsonFragment(['title' => 'Custom Tour']);


        // Assert that the response JSON has the same number of artworks as the original $data
        $getResponse->assertJsonCount(count($data['artworks']), 'tour_json.artworks');

    }
}
