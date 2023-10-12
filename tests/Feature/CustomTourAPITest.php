<?php

namespace Tests\Feature;

use Aic\Hub\Foundation\Testing\FeatureTestCase as BaseTestCase;

class CustomTourAPITest extends BaseTestCase
{
    /**
     * A feature test to test the Custom Tours API POST and GET routes.
     */
    public function test_create_and_get_custom_tour()
    {
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
        // Note: Unable to use route() here as APP_URL doesn't have a protocol
        $postResponse = $this->json('POST', 'https://' . config('app.url') . '/api/v1/custom-tours', $data);

        // Check the response has a status code of 201
        $postResponse->assertStatus(201);

        // Send a GET request to the custom tours API route, using the id of the newly created Custom Tour
        $getResponse = $this->json('GET', route('custom-tours-api.show', ['id' => 1]));


        // Check the response has a status code of 200
        $getResponse->assertStatus(200);

        // Check that the response JSON has the expected structure
        $getResponse->assertJsonStructure([
            'tour_json' => [
                'title',
                'description',
                'artworks',
            ],
        ]);

        // Check that the response JSON has the expected 'title'
        $getResponse->assertJsonFragment(['title' => 'Custom Tour']);


        // Check that the response JSON has the same number of artworks as the original $data
        $getResponse->assertJsonCount(count($data['artworks']), 'tour_json.artworks');
    }

    /**
     * A feature test to test the Custom Tours validation rules
     * (title is required).
     */
    public function test_custom_tour_missing_title_validation()
    {
        // The JSON data to send to the API
        // Intentionally missing "title"
        $data = [
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
        // Note: Unable to use route() here as APP_URL doesn't have a protocol
        $postResponse = $this->json('POST', 'https://' . config('app.url') . '/api/v1/custom-tours', $data);

        // Check that the response has a status code of 422
        $postResponse->assertStatus(422);
    }

    /**
     * A feature test to test the Custom Tours validation rules
     * (artworks are required).
     */
    public function test_custom_tour_missing_artworks_validation()
    {
        // The JSON data to send to the API
        // Intentionally missing "artworks"
        $data = [
            "title" => "Custom Tour",
            "description" => "Custom tour (optional) description",
        ];

        // Send a POST request to the custom tours API route
        // Note: Unable to use route() here as APP_URL doesn't have a protocol
        $postResponse = $this->json('POST', 'https://' . config('app.url') . '/api/v1/custom-tours', $data);

        // Check that the response has a status code of 422
        $postResponse->assertStatus(422);
    }

    /**
     * A feature test to test the Custom Tours validation rules
     * (artwork title must be string).
     */
    public function test_custom_tour_incorrect_type_validation()
    {
        // The JSON data to send to the API
        // Intentionally has an array as the artworks.title (only accepts a string)
        $data = [
            "title" => "Custom Tour",
            "description" => "Custom tour (optional) description",
            "artworks" => [
                [
                    "id" => 730796,
                    "title" => ["Artwork one", "Artwork two", "Artwork three", "Artwork four"],
                    "objectNote" => "A short note about the artworks."
                ],
            ]
        ];

        // Send a POST request to the custom tours API route
        // Note: Unable to use route() here as APP_URL doesn't have a protocol
        $postResponse = $this->json('POST', 'https://' . config('app.url') . '/api/v1/custom-tours', $data);

        // Check that the response has a status code of 422
        $postResponse->assertStatus(422);
    }
}
