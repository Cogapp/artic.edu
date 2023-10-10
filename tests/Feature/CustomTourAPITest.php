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
        $currentUrl = getMainEnvAppUrl();

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
        $postResponse = $this->json('POST', $currentUrl . '/api/v1/custom-tours', $data);

        // Assert that the response has a status code of 201 (Created)
        $postResponse->assertStatus(201);

        // Send a GET request to the custom tours API route, using the id of the newly created Custom Tour
        $getResponse = $this->json('GET', $currentUrl . '/api/v1/custom-tours/1');

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

/**
 * Get APP_URL from the main .env, as opposed to .env.testing
 *
 * This method uses preg_match to search .env for the APP_URL and return it
 * without the wrapping quote marks
 *
 */
function getMainEnvAppUrl(): string
{
    $envFilePath = base_path('.env');
    $envContent = file_get_contents($envFilePath);
    preg_match('/APP_URL=(.*)/', $envContent, $matches);

    return trim($matches[1] ?? null, '"');
}
