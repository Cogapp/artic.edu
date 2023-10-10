<?php

namespace Tests\Feature;

use Aic\Hub\Foundation\Testing\FeatureTestCase as BaseTestCase;
use Illuminate\Support\Facades\Request;

class CustomTourAPITest extends BaseTestCase
{
    /**
     * A basic feature test example.
     */
    public function testCreateCustomTour()
    {
//      $currentUrl = Request::url();
        $currentUrl = 'https://artic.edu.ddev.site/';

        // Define the JSON data to send to the API
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
        $response = $this->json('POST', 'https://artic.edu.ddev.site/api/v1/custom-tours', $data);

        // Assert that the response has a status code of 201 (Created)
        $response->assertStatus(201);
    }
}
