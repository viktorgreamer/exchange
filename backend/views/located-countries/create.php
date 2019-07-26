<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LocatedCountries */

$this->title = 'Create Located Countries';
$this->params['breadcrumbs'][] = ['label' => 'Located Countries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="located-countries-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
