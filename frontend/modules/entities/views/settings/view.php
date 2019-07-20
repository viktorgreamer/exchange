<?php

use common\models\Entities;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Entities */


$model = Yii::$app->user->identity->entity;

$this->title = $model ? $model->name : "Создать профиль.";
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Entities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="entities-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <? if ($model) { ?>

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


        <?php echo DetailView::widget([
            'model' =>$model,
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

                ], [
                    'attribute' => 'has_one_opening_hours',
                    'filter' => [0 => 'Нет', 1 => "Да"],
                    'value' => function (Entities $model) {
                        return $model->has_one_opening_hours ? 'Да' : 'Нет';
                    }

                ],
                'phone',

            ],
        ]);
    } else {
        ?>
        <p>
            <?= Html::a(Yii::t('app', 'Create Entities'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?php
    }
    ?>

</div>
