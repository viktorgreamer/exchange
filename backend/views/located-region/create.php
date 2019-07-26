<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LocatedRegion */

$this->title = 'Create Located Region';
$this->params['breadcrumbs'][] = ['label' => 'Located Regions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="located-region-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
