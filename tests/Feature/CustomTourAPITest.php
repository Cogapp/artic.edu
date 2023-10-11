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

        $this->addMockApiResponses($this->mockApiModelReponse($customTour, 201));

        $postResponse = $this->post(route('custom-tours-api.store'), $customTour->toArray());

        // Check the response has a status code of 201
        $postResponse->assertStatus(201);
    }
}
