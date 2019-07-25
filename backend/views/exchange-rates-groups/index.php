<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ExchangeRatesGroupsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Exchange Rates Groups';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exchange-rates-groups-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Exchange Rates Groups', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'entity_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
