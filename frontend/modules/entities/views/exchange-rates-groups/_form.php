<?php

use common\models\Pairs;
use unclead\multipleinput\MultipleInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ExchangeRatesGroups */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="exchange-rates-groups-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'exchangeRates')->widget(MultipleInput::className(), [
        'addButtonPosition' => MultipleInput::POS_HEADER,
        'min' => 3,
        'max' => Pairs::find()->count(),
        'columns' => [
            [
                'name' => 'pair_id',
                'type' => 'dropDownList',
                'title' => 'Валютная пара',
                'items' => Pairs::map(),
            ],
            [
                'name' => 'buy',
                'title' => 'Покупка',
                'options' => [
                    'class' => 'input-priority'
                ]
            ],
            [
                'name' => 'sell',
                'title' => 'Продажа',
                'options' => [
                    'class' => 'input-priority'
                ]
            ]
        ]
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
