<?php

use common\models\ExchangeRatesGroups;
use common\models\GroupExchangeRates;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ExchangeRatesGroupsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Группа курсов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exchange-rates-groups-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить Группу курсов', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            [
                'label' => 'Курсы',
                'format' => 'html',
                'value' => function (ExchangeRatesGroups $model) {
                    return $model->rates;
                }],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
