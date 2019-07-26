<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LocatedVillage */

$this->title = 'Update Located Village: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Located Villages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="located-village-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
