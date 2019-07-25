<?php

use common\models\Cities;
use common\models\OpeningHours;
use common\models\Regions;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use unclead\multipleinput\MultipleInput;

/* @var $this yii\web\View */
/* @var $model common\models\ExchangePoints */
/* @var $form yii\widgets\ActiveForm */
?>

    <div class="exchange-points-form">

        <?php $form = ActiveForm::begin(); ?>



        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'main')->checkbox() ?>

        <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'city_id')->dropDownList(Cities::map()) ?>
        <?= $form->field($model, 'region_id')->dropDownList(ArrayHelper::map(Regions::find()->andFilterWhere(['city_id' => $model->city_id])->all(), 'id', 'name')) ?>

        <?php
        $js = <<<JS
$(document).on('change','#exchangepoints-city_id', function() {
let city_id = $(this).val();
console.log(city_id);

$.ajax({
  url: '/site/regions-map?city_id=' + city_id,
  success: function(data) {
  data = JSON.parse(data);
   let options = [];
  data.forEach(function(item) {
  options.push('<option value="' + item.id + '">' + item.name + '</option>');
  
  });
  $('#exchangepoints-region_id').html(options.join(""));
  },
});

});

JS;
        $this->registerJs($js, 4);
        ?>
        <?= $form->field($model, 'phone1')->widget(\yii\widgets\MaskedInput::className(), [
            'mask' => '+999999999999',
        ]) ?>


        <?= $form->field($model, 'phone2')->widget(\yii\widgets\MaskedInput::className(), [
            'mask' => '+999999999999',
        ]) ?>

        <?= $form->field($model, 'viber')->widget(\yii\widgets\MaskedInput::className(), [
            'mask' => '+999999999999',
        ]) ?>

        <?= $form->field($model, 'telegram')->widget(\yii\widgets\MaskedInput::className(), [
            'mask' => '+999999999999',
        ]) ?>

        <?= $form->field($model, 'skype')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'schedule')->widget(MultipleInput::className(), [
            'min' => 7,
            'max' => 7,
            'columns' => [
                [
                    'name' => 'day',
                    'type' => 'dropDownList',
                    'title' => 'День недели',
                    'items' => OpeningHours::mapDays(),
                ],

                [
                    'name' => 'time_start',
                    'type' => 'dropDownList',
                    'title' => 'С',
                    'items' => OpeningHours::map(),
                    'enableError' => true,
                    'options' => [
                        'class' => 'input-priority'
                    ]
                ],
                [
                    'name' => 'time_end',
                    'type' => 'dropDownList',
                    'title' => 'До',
                    'items' => OpeningHours::map(),
                    'enableError' => true,
                    'options' => [
                        'class' => 'input-priority'
                    ]
                ], [
                    'name' => 'break_time_start',
                    'type' => 'dropDownList',
                    'title' => 'Обед с',
                    'items' => OpeningHours::map(),
                    'enableError' => true,
                    'options' => [
                        'class' => 'input-priority'
                    ]
                ],
                [
                    'name' => 'break_time_end',
                    'type' => 'dropDownList',
                    'title' => 'Обед до',
                    'items' => OpeningHours::map(),
                    'enableError' => true,
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
<?php
$js = <<<JS
// exchangepoints-address
JS;
$this->registerJs($js, 4);


?>