<?php

use common\models\Entities;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\EntitiesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Entities');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entities-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Entities'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
           // 'user_id',
            'name',
            [
                'attribute' => 'has_one_currency',
                'filter' => [0 => 'Нет', 1 => "Да"],
                'value' => function (Entities $model) {
                    return $model->has_one_currency ? 'Да' : 'Нет';
                }

            ],[
                'attribute' => 'has_one_opening_hours',
                'filter' => [0 => 'Нет', 1 => "Да"],
                'value' => function (Entities $model) {
                    return $model->has_one_opening_hours ? 'Да' : 'Нет';
                }

            ],
            //'phone',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
