<?php

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\App;

namespace App\Models\Behaviors;

trait HasApiSource
{
    /**
     * Indicates if the fields have been refresh using the API
     *
     * @var bool
     */
    private $apiFilled = false;

    /**
     * Refresh the model with API values in case it's not done yet.
     * TODO: Solve the collision cases. Probably using an identity array.
     *
     * @var bool
     */
    public function refreshApi($params = [])
    {
        if (!$this->apiFilled) {

            // Load the API endpoint and setup all fields
            $apiFields = $this->request($params);

            foreach($apiFields as $key => $value) {
                if ($this->hasAttribute($key)) {
                    // TODO: If the attribute already exists un-tie with a mapping array and set the attr.
                    // Something like ['id' => 'datahub_id']
                } else {
                    $this->setAttribute($key, $value);
                }
            }

            $this->apiFilled = true;
        }
        return $this;
    }

    public function hasAttribute($attr)
    {
        return array_key_exists($attr, $this->attributes);
    }

    /**
     * Get API endpoint. Replace brackets {name} with the 'name' attribute value (usually datahub_id)
     *
     * This way you can define an endpoint like:
     * protected $endpoint = '/api/v1/exhibitions/{datahub_id}/artwork/{id}';
     *
     * And the elements will be dinamically replaced with eloquent values
     *
     * @return string
     */
    public function getEndpoint()
    {
        return preg_replace_callback('!\{(\w+)\}!', function($matches) {
            $name = $matches[1];
            return $this->$name;
        }, $this->endpoint);
    }

    /**
     * Perform a request to the API client.
     * TODO: Add error controls and more configurations
     *
     * @return mixed
     */
    protected function request($params = [])
    {
        $client = \App::make('ApiClient');
        $response = $client->request('GET', $this->getEndpoint(), $params);

        $body = json_decode($response->getBody()->getContents());

        // TODO: Perform some error controls
        $statusCode = $response->getStatusCode();

        return $body->data;
    }

}
