<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\GroupExchangeRates */

$this->title = 'Добавить Групповые курсы';
$this->params['breadcrumbs'][] = ['label' => 'Групповые курсы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="group-exchange-rates-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
