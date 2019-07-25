<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\GroupExchangeRates */

$this->title = 'Create Group Exchange Rates';
$this->params['breadcrumbs'][] = ['label' => 'Group Exchange Rates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-exchange-rates-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
