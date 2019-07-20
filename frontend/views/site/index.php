<?php

use common\models\Programs;
use common\models\Reviews;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<?= yii\authclient\widgets\AuthChoice::widget([
     'baseAuthUrl' => ['site/auth'],
     'popupMode' => false,
]) ?>
<?php

/** @var \yii\web\View $this */

?>
