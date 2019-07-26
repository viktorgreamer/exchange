<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LocatedArea */

$this->title = 'Create Located Area';
$this->params['breadcrumbs'][] = ['label' => 'Located Areas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="located-area-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
