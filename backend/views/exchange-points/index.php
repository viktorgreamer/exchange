<?php

use common\models\Entities;
use common\models\ExchangePoints;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ExchangePointsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', ' Пункты обмена');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exchange-points-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create  Пункты обмена'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',

            [
                    'attribute' => 'address',
                'format' => 'html',
                'value' => function (ExchangePoints $model) {
                    return $model->city->name."<br>".$model->region->name."<br>".$model->address;
                }
            ],
            [
                    'attribute' =>  'entity_id',
                'label' => 'Компания',
                'format' => 'html',
                'filter' => Entities::map(),
                'value' => function (ExchangePoints $model) {
                    return $model->entity->name;
                }
            ],


            //'phone1',
            //'phone2',
            //'name',
            //'link',
            // 'status',
            [
                'label' => 'Ставки',
                'format' => 'html',
                'value' => function (ExchangePoints $model) {
                return $model->rates;
            }],
            //'rating',
            //'rating_geo',
            //'rating_actuality',
            //'rating_service',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
