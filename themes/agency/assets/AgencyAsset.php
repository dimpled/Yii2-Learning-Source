<?php
namespace agency\assets;

use yii\web\AssetBundle;

class AgencyAsset extends AssetBundle
{
    //public $basePath = '@app/themes/agecents';
    //public $baseUrl = '@web/themes/agecents';
    public $sourcePath = '@agency/dist'; 
    public $css = [
        'css/agency.css',
        '//fonts.googleapis.com/css?family=Montserrat:400,700',
        '//fonts.googleapis.com/css?family=Kaushan+Script',
        '//fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic',
        '//fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700'
    ];
    
    public $js = [
        '//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js',
        'js/jquery-scrollspy.js',
        //'js/cbpAnimatedHeader.min.js',
        'js/classie.js',
        'js/contact_me.js',
        'js/jqBootstrapValidation.js',
        'js/agency.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'agency\assets\FontAwesomeAsset'
    ];
}
