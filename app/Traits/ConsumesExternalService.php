<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait ConsumesExternalService 
{

    /**
     * Send a request to any service
     * @return string
     */
    public function performRequest($method, $requestUri, $formParams = [], $headers = [])
    {
        $client = new Client([
            'base_uri' => $this->baseUri,
        ]);

        if (isset($this->secret)) {
            $headers['Authorization'] = $this->secret;
        }

        $response = $client->request($method, $requestUri, ['form_params' => $formParams, 'headers' => $headers]);

        return $response->getBody()->getContents();
    }
}