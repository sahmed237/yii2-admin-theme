<?php
namespace sahmed237\yii2admintheme\assets;

use yii\web\AssetBundle;

class AdminThemeAsset extends AssetBundle
{
    public $sourcePath = '@vendor/sahmed237/yii2-admin-theme/src/assets';
    
    public $css = [
        'css/bootstrap.min.css',
        'css/icons.min.css',
        'css/app.min.css',
        'libs/choices.js/public/assets/styles/choices.min.css',
        'dist/css/custom.css', // Custom styles
    ];

    public $js = [
        'libs/bootstrap/js/bootstrap.bundle.min.js',
        'libs/simplebar/simplebar.min.js',
        'libs/node-waves/waves.min.js',
        'libs/feather-icons/feather.min.js',
        'js/layout.js',
        'js/app.js',
        'dist/js/custom.js', // Custom scripts
        'libs/choices.js/public/assets/scripts/choices.min.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
        'sahmed237\yii2admintheme\assets\SortableJsAsset',
    ];
} 