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
    /*  #map {
          width: 700px;
          height: 600px;
      }*/

    .iframe-container {
        position: relative;
        width: 100%;
        padding-bottom: 100%; /* Ratio 16:9 ( 100%/16*9 = 56.25% ) */
    }

    .iframe-container > * {
        display: block;
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        margin: 0;
        padding: 0;
        height: 100%;
        width: 100%;
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
                <div class="col-lg-4 col-md-6 col-xs-6 col-6">
                    <select v-model="city_id" class="form-control" @change="getRegions();getRates();">
                        <option v-for="city in cities" v-bind:value="city.id"> {{ city.name }}</option>
                    </select>
                </div>
                <div class="col-lg-4 col-md-6 col-xs-6 col-6">
                    <select v-model="region_id" class="form-control" @change="getRates()">
                        <option v-for="region in regions" v-bind:value="region.id"> {{ region.name }}</option>
                    </select>
                </div>
                <div class="col-lg-4 col-md-6 col-xs-6 col-6">
                    <select v-model="pair_id" class="form-control" @change="getRates()">
                        <option v-for="pair in pairs" v-bind:value="pair.id"> {{ pair.render }}</option>
                    </select>
                </div>
                <div class="col-lg-4 col-md-6 col-xs-12 col-12">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-xs-5 col-5 text-right">
                            Покупка
                        </div>
                        <div class="col-lg-2 col-md-2 col-xs-2 col-2">
                            <div class="material-switch">
                                <input id="someSwitchOptionSuccess" name="someSwitchOption001" v-model="type" class="form-control" @change="getRates()" type="checkbox"/>
                                <label for="someSwitchOptionSuccess" class="label-success">
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-xs-4 col-4 text-left">
                            Продажа
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="iframe-container">
            <div id="map">
            </div>
        </div>

        <!--<div class="row">
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

-->

    </div>
</div>


<?php

?>

