<?php

use common\models\ExchangePoints;
use common\models\ExchangeRates;
use common\models\Pairs;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ExchangeRatesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Exchange Rates');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exchange-rates-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'attribute' => 'point_id',
                'label' => 'Пункт обмена',
                'filter' => ExchangePoints::map(),
                'value' => function (ExchangeRates $model) {
                    return $model->point->name;
                },
            ],

            [
                'attribute' => 'pair_id',
                'filter' => Pairs::map(),
                'value' => function (ExchangeRates $model) {
                    return $model->pair->render;
                },
            ],
            //status',
            'buy',
            'sell',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
