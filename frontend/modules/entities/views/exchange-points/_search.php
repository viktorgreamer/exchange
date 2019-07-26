<?php

use common\models\Cities;
use common\models\ExchangePoints;
use yii\helpers\ArrayHelper;
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
            <?= $form->field($model, 'query') ?>

        </div>
        <div class="col-lg-3">
            <?php echo $form->field($model, 'city_id')->dropDownList(
                    [null => ''] + ArrayHelper::map(Cities::find()
                        ->where([
                                'id' => ExchangePoints::find()->select('city_id')
                                    ->andWhere(['entity_id' => Yii::$app->user->identity->entity->id])
                                    ->groupBy('city_id')
                                    ->column()
                        ])->all(),'id','name'));
            ?>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Поиск'), ['class' => 'btn btn-primary']) ?>
            </div>

        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
