<?php

namespace frontend\controllers;

use common\models\Cities;
use common\models\ExchangeRatesSearch;
use common\models\Pairs;
use common\models\Regions;
use common\models\services\GoogleGeolocation;
use yii\rest\Controller;

/**
 * Site controller
 */
class ApiController extends Controller
{

    public function actionRegionsMap($city_id)
    {
        $items = [];
        if ($regions = Regions::find()->where(['city_id' => $city_id])->all()) {
            foreach ($regions as $region) {
                $items[] = ['id' => $region->id, 'name' => $region->name];
            }
        }

        return $items;
    }

    public function actionGeocode($address)
    {
        $google = new GoogleGeolocation($address);
        $google->handle();

        if ($google->status) {
            return $google->getResponses();
        }
    }

    public function actionPairs()
    {
        return Pairs::find()->all();
    }

    public function actionCities()
    {
        return Cities::find()->asArray()->all();
    }

    public function actionRegions($city_id)
    {
        return Regions::find()->andWhere(['city_id' => $city_id])->all();
    }
}
