<?php
namespace sahmed237\yii2admintheme\assets;

use yii\web\AssetBundle;

class SortableJsAsset extends AssetBundle
{
    public $sourcePath = __DIR__ . '/dist/sortablejs';

    public $js = [
        'Sortable.min.js',
    ];
} 