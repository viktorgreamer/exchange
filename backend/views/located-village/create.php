<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LocatedVillage */

$this->title = 'Create Located Village';
$this->params['breadcrumbs'][] = ['label' => 'Located Villages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="located-village-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
