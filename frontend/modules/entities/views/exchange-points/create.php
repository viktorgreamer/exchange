<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ExchangePoints */

$this->title = Yii::t('app', 'Добавить точку обмена');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Пункты обмена'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exchange-points-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
