<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ExchangeRatesGroups */

$this->title = 'Редактировать Группу курсов: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Группа курсов', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="exchange-rates-groups-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
