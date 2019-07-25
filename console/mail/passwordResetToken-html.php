<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user app\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
    <p>Hi, <?= Html::encode($user->getFullName()) ?>,</p>
    You recently requested to reset your password for your account.Use the button below to reset it.This password reset is only valid for the next 24 hours.
    <?= Html::a('Reset your password', $resetLink) ?>
   <br> Thanks,<br>
    The Nest Securities Team.<br>
    For security, this request was received from a <?= $user->getOS(); ?> device using <?= $user->getBrowser(); ?>.If you did not request a password reset,please ignore this email or contact support if you have questions.
    If you're having trouble with the button above ,copy and paste the URL below into your web browser.
    <br>
    <?php echo $resetLink; ?>

</div>
