<?php
namespace App\Services;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;

class GeocodeService
{
    /**
     *
     */
    private $client;

    /**
     *
     */
    private $config;

    /**
     * Geocode Service
     */
    public function __construct()
    {
        $this->config = config('services.geocode');

        $this->client = new GuzzleHttpClient([
            'base_uri' => $this->config['url']
        ]);
    }

    /**
     *
     */
    private function _postRequest($uri, array $query)
    {
        try {
            $options = [
                'query' => $query,
            ];

            $apiRequest = $this->client->post($uri, $options);

            return  json_decode($apiRequest->getBody()->getContents());
        } catch (RequestException $re) {
            throw $re;
        }
    }
    /**
     * @param string $address
     * @return mixed
     */
    public function getCoordinates($address)
    {
        try {
            $json = $this->_postRequest('/maps/api/geocode/json', [
                'address'   =>  $address,
                'key'   =>  $this->config['key']
            ]);

            return [
                'lat'   =>  $json->results[0]->geometry->location->lat ?? null,
                'long'  =>  $json->results[0]->geometry->location->lng ?? null
            ];

        } catch (RequestException $re) {
            throw $re;
        }
    }

}
