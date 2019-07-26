<?php

use common\models\Pairs;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use unclead\multipleinput\MultipleInput;

/* @var $this yii\web\View */
/* @var $model common\models\ExchangePoints */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('app', 'Редактирование курсов', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Exchange Points'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Редактировать');
?>
<div class="exchange-points-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="exchange-points-form">
        <div class="row">
            <div class="col-lg-6">
                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'exchangeRates')->widget(MultipleInput::className(), [
                        'addButtonPosition' => MultipleInput::POS_HEADER,
                    'min' => 3,
                    'max' => Pairs::find()->count(),
                    'columns' => [
                        [
                            'name' => 'id',
                            'type' => 'hiddenInput',
                        ],
                        [
                            'name' => 'point_id',
                            'type' => 'hiddenInput',
                            'title' => 'Валютная пара',
                            'value' => $model->id
                        ],
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
                    <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>


    </div>
</div>
