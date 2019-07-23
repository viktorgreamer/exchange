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

<style>
    /* Always set the map height explicitly to define the size of the div
     * element that contains the map. */
    #map {
        width: 700px;
        height: 600px;
    }

    /* Optional: Makes the sample page fill the window. */
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }
</style>

<div class="row">
    <div class="col-lg-6">
        <div id="app">
            <div class="row">
                <div class="col-lg-4">
                    <select v-model="city_id" class="form-control" @change="getRegions();getRates();">
                        <option v-for="city in cities" v-bind:value="city.id"> {{ city.name }}</option>
                    </select>
                </div>
                <div class="col-lg-4">
                    <select v-model="type" class="form-control" @change="getRates()">
                        <option value="buy"> Продажа</option>
                        <option value="sell"> Покупка</option>
                    </select>
                </div>
                <div class="col-lg-4">
                    <select v-model="region_id" class="form-control" @change="getRates()">
                        <option v-for="region in regions" v-bind:value="region.id"> {{ region.name }}</option>
                    </select>
                </div>
                <div class="col-lg-4">
                    <select v-model="pair_id" class="form-control" @change="getRates()">
                        <option v-for="pair in pairs" v-bind:value="pair.id"> {{ pair.render }}</option>
                    </select>
                </div>
            </div>

            <table class="table table-striped table-hover ">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Валюты</th>
                    <th>Точка</th>
                    <th>Buy</th>
                    <th>Sell</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="rate in rates">
                    <td>1</td>
                    <td>{{rate.pair.name}}</td>
                    <td>{{rate.point.name}}</td>
                    <td>{{ rate.buy }}</td>
                    <td>{{rate.sell }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-6">

        <div id="map"></div>
    </div>
</div>


<?php

?>

