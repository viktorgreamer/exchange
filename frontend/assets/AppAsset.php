<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.min.css',
        'css/site.css',
    ];

    public $js = [
        'js/main.js',
        'js/vue.js',
        'js/axios.js',
        'https://maps.googleapis.com/maps/api/js?key=AIzaSyDy19iLKmlTFbnOwM3FHXJH5z1rTCkAkj8',
        'js/map.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
