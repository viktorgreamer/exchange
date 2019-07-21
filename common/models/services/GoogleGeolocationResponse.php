<?php
/**
 * Created by PhpStorm.
 * User: anvik
 * Date: 21.07.2019
 * Time: 14:10
 */

namespace common\models\services;


class GoogleGeolocationResponse
{

    public $street;
    public $city;
    public $house;
    public $lat;
    public $lng;

    public function getFullAddress()
    {

        $components = [];
        if ($this->city) $components[] = $this->city;
        $components[] = $this->getShortAddress();

        return implode(", ", $components);
    }

    public function getShortAddress()
    {
        $components = [];
        if ($this->street) $components[] = $this->street;
        if ($this->house) $components[] = $this->house;

        return implode(", ", $components);
    }

}