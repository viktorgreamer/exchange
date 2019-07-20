<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\OpeningHours */

$this->title = Yii::t('app', 'Create Opening Hours');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Opening Hours'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="opening-hours-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
