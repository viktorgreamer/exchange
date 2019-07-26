<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\LocatedAreaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Located Areas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="located-area-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Located Area', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'country_id',
            'region_id',
            'area',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
