<?php

use common\models\Cities;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ExchangePointsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exchange-points-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>
    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'address') ?>

        </div>
        <div class="col-lg-3">
            <?php echo $form->field($model, 'city_id')->dropDownList(Cities::map()); ?>
        </div>
        <div class="col-lg-3">
            <?php echo $form->field($model, 'name') ?>

        </div><div class="col-lg-3">
            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Поиск'), ['class' => 'btn btn-primary']) ?>
                <?= Html::resetButton(Yii::t('app', 'Сбросить'), ['class' => 'btn btn-outline-secondary']) ?>
            </div>

        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
