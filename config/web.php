<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'language'=>'th',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases'=>[
        '@agency' => '@app/themes/agency',
    ],
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'enableUnconfirmedLogin' => true,
            'confirmWithin' => 21600,
            'cost' => 12,
            'admins' => ['admin']
        ],
       'gridview' =>  [
            'class' => '\kartik\grid\Module'
            // enter optional module parameters below - only if you need to
            // use your own export download action or custom translation
            // message source
            // 'downloadAction' => 'gridview/export/download',
            // 'i18n' => []
        ]
    ],
    'components' => [
        'thaiYearFormatter'=>[
            'class'=>'app\components\ThaiYearFormatter'
        ],
        // 'view' => [
        //      'theme' => [
        //          'pathMap' => [
        //             '@app/views' => '@agency/views', // uncomment active agency theme
        //             //'@app/views' => '@app/themes/adminlte' // uncomment active adminlte theme
        //          ],
        //      ],
        // ],
        'image' => [
                'class' => 'yii\image\ImageDriver',
                'driver' => 'GD',  //GD or Imagick
        ],
        'urlManager' => [
           'class' => 'yii\web\UrlManager',
           // Disable index.php
           'showScriptName' => false,
           // Disable r= routes
           'enablePrettyUrl' => true,
           'rules' => [
                   '<controller:\w+>/<id:\d+>' => '<controller>/view',
                   '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                   '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                   ['class' => 'yii\rest\UrlRule', 'controller' => 'location', 'except' => ['delete','GET', 'HEAD','POST','OPTIONS'], 'pluralize'=>false],
                   '<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
           ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'mldcOhzqWMRgnEnGwqMKxIaiUJHiL_te',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],

        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            //'identityClass' => 'app\models\User',
            'identityClass' => 'dektrium\user\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
           'class' => 'yii\swiftmailer\Mailer',
                'viewPath' => '@app/mail',
                'useFileTransport' => false,
                'transport' => [
                    'class' => 'Swift_SmtpTransport',
                    'host' => 'smtp.gmail.com',
                    'username' => 'email@gmail.com',
                    'password' => 'xxxxxxxxx',
                    'port' => '587',
                    'encryption' => 'tls',
                ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
