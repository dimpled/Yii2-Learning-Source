<?php
namespace agency\assets;

use yii\web\AssetBundle;

class FontAwesomeAsset extends AssetBundle 
{
    public $sourcePath = '@bower/fontawesome'; 
    public $css = [ 
        'css/font-awesome.min.css', 
    ];
    public $publishOptions = [
        'only' => [
            'fonts/',
            'css/',
        ]
    ];
}