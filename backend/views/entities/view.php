<?php

use common\models\Entities;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Entities */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Entities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="entities-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          //  'id',
          //  'user_id',
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
            'phone',

        ],
    ]) ?>

</div>
