<?php

use common\models\Currencies;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Pairs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pairs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'currency_from_id')->dropDownList(Currencies::map()) ?>

    <?= $form->field($model, 'currency_to_id')->dropDownList(Currencies::map()) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
