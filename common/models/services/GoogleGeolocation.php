<?php
/**
 * Created by PhpStorm.
 * User: anvik
 * Date: 21.07.2019
 * Time: 14:07
 */

namespace common\models\services;

use yii\helpers\ArrayHelper;

class GoogleGeolocation
{
    private $url = 'https://maps.googleapis.com/maps/api/geocode/json?';
    private $address;
    private $key;
    private $responses = [];
    public $language = 'ru';

    public $status = false;


    public function __construct($address, $key = null)
    {
        $this->key = $key ?: ArrayHelper::getValue(\Yii::$app->params, 'google-api-key');
        $this->address = $address;

    }

    public function handle()
    {
        $this->request();
    }

    /**
     * @return GoogleGeolocationResponse[]
     */
    public function getResponses() {
        return $this->responses;
    }

    private function request()
    {

        $url = $this->url . http_build_query(['address' => $this->address, 'language' => $this->language, 'key' => $this->key]);

        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $url);

        $body = \GuzzleHttp\json_decode($response->getBody()->getContents(), true);
        // print_r(ArrayHelper::getValue($body, 'results'));
        if (ArrayHelper::getValue($body, 'status') == 'OK') {

            $this->status = true;

            foreach (ArrayHelper::getValue($body, 'results') as $result) {

                $response = new GoogleGeolocationResponse();

                if ($components = ArrayHelper::getValue($result, 'address_components')) {
                    $response->street = ArrayHelper::getValue(reset(array_filter($components, function ($item) {
                        return in_array('route', ArrayHelper::getValue($item, 'types'));
                    })), 'short_name');

                    $response->city = ArrayHelper::getValue(reset(array_filter($components, function ($item) {
                        return in_array('locality', ArrayHelper::getValue($item, 'types'));
                    })), 'short_name');

                    $response->house = ArrayHelper::getValue(reset(array_filter($components, function ($item) {
                        return in_array('street_number', ArrayHelper::getValue($item, 'types'));
                    })), 'short_name');

                }

                $response->lat = ArrayHelper::getValue($result, 'geometry.location.lat');
                $response->lng = ArrayHelper::getValue($result, 'geometry.location.lng');
                $this->responses[] = $response;
            }
        }


    }

}