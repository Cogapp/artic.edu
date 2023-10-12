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
    public function test_create_and_get_custom_tour()
    {

        $tourData = [
            "title" => "My custom tour title",
            "descriptions" => "My tour description",
            "artworks" => [
                [
                    "id" => 656,
                    "title" => "Lion (One of a Pair, South Pedestal)",
                    "objectNote" => "note about the lion",
                ],
            ],
        ];

        $customTour = new CustomTour();
        $customTour->tour_json = json_encode($tourData);
        $customTour->save();

        $this->addMockApiResponses($this->mockApiModelReponse($customTour, 201));

        $postResponse = $this->postJson(route('custom-tours-api.store'), json_decode($customTour->tour_json, true));
        
        // Check the response has a status code of 201
        $postResponse->assertStatus(201);
    }
}
