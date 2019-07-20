<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class VueAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.min.css',
        'css/font-awesome.min.css',
        'css/site.css',
        'js/highlight/styles/dark.css',
        'http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css',
        'css/table.css',
        'css/vuetable.css',

    ];
    public $js = [
        'js/main.js',
         'js/highlight/highlight.pack.js',
         'http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js',
         'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
        'js/vue.js',
        'js/axios.js',
        'js/vuetable.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];



}
