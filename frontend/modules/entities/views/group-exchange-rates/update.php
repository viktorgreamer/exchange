<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\GroupExchangeRates */

$this->title = 'Update Групповые курсы: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Групповые курсы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="group-exchange-rates-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
