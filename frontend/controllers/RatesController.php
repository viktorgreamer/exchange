<?php

namespace frontend\controllers;

use common\models\ExchangeRatesSearch;
use yii\rest\ActiveController;


/**
 * Site controller
 */
class RatesController extends ActiveController
{

    public $modelClass = '\common\models\ExchangeRates';


    public function actions()
    {
        $actions = parent::actions();

        // disable the "delete" and "create" actions
        unset($actions['delete'], $actions['create'], $actions['update']);

        // customize the data provider preparation with the "prepareDataProvider()" method
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

        return $actions;
    }

    public function prepareDataProvider()
    {
        $search = new ExchangeRatesSearch();

        return $search->search(\Yii::$app->request->queryParams);

    }

}
