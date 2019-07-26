<?php

use common\models\ExchangePoints;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ExchangePointsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Пункты обмена');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exchange-points-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a(Yii::t('app', 'Добавить пункт обмена'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'name',
                'format' => 'html',
                'value' => function (ExchangePoints $model) {
                    return Html::a($model->name, Url::to(['exchange-points/view','id' => $model->id]));
                }
            ],

            [
                    'attribute' => 'address',
                'format' => 'html',
                'value' => function (ExchangePoints $model) {
                    return $model->city->name."<br>".$model->region->name."<br>".$model->address;
                }
            ],


            //'phone1',
            //'phone2',
            //'name',
            //'link',
            // 'status',
            [
                'label' => 'Курсы',
                'format' => 'html',
                'value' => function (ExchangePoints $model) {
                return $model->rates;
            }],
           /* ['attribute' => 'main',
                'format' => 'html',
                'value' => function (ExchangePoints $model) {
                    return $model->main ? $model->attributeLabels()['main'] : "Дополнительный офис";
                }
            ],*/
            //'rating',
            //'rating_geo',
            //'rating_actuality',
            //'rating_service',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
