<?php

use common\models\ExchangeRates;
use common\models\OpeningHours;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ExchangePoints */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Exchange Points'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="exchange-points-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Редактировать'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Редактировать Курсы'), ['exchange-points/update-currencies', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Удалить'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Вы действительно хотите удалить точку обмена?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="row">
        <div class="col-lg-6">
            <h5> Ставки</h5>
            <?php
            echo \yii\grid\GridView::widget([
                'dataProvider' => new ActiveDataProvider([
                    'query' => $model->getExchangeRates()->orderBy('pair_id')]),
                'layout' => '{items}',
                'columns' => [
                    [
                        'attribute' => 'pair_id',
                        'value' => function (ExchangeRates $model) {
                            return $model->pair->render;
                        }],
                    [
                        'attribute' => 'buy',
                        'value' => function (ExchangeRates $model) {
                            return $model->buy;
                        }],
                    [
                        'attribute' => 'sell',
                        'value' => function (ExchangeRates $model) {
                            return $model->sell;
                        }],


                ]
            ]);
            ?>
        </div>
        <div class="col-lg-6">
            <h5> График работы</h5>
            <?php
            echo \yii\grid\GridView::widget([
                'dataProvider' => new ActiveDataProvider([
                    'query' => $model->getOpeningHours()->orderBy('day')]),
                'layout' => '{items}',
                'columns' => [
                    [
                        'attribute' => 'day',
                        'value' => function (OpeningHours $model) {
                            return OpeningHours::mapDays()[$model->day];
                        }],
                    [
                        'attribute' => 'time_start',
                        'value' => function (OpeningHours $model) {
                            return OpeningHours::map()[$model->time_start];
                        }], [
                        'attribute' => 'time_end',
                        'value' => function (OpeningHours $model) {
                            return OpeningHours::map()[$model->time_end];
                        }],


                ]
            ]);
            ?>
        </div>

        <div class="col-lg-6">
            <h5> Основные данные</h5>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'address',
                    'entity.name',
                    'city.name',
                    'region.name',
                    'phone1',
                    'phone2',
                    'name',
                    'link',
                    'rating',
                    'rating_geo',
                    'rating_actuality',
                    'rating_service',
                ],
            ]) ?>

        </div>
    </div>

</div>

