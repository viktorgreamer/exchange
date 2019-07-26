<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LocatedCountries */

$this->title = 'Update Located Countries: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Located Countries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="located-countries-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
