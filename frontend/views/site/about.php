<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>This is the About page. You may modify the following file to customize its content:</p>

    <code><?= __FILE__ ?></code>
</div>

<div id="review-form">
    <form>
        {{ message }}
        <input style="display: none" v-model="currentRating">
        <div class="inline">
            <i v-for="rating in ratings" :class="getClass(rating)" @click="setRating(rating)" aria-hidden="true"></i>
        </div>
    </form>
</div>
