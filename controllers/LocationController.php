<?php
namespace app\controllers;

use yii\rest\ActiveController;
use yii\models\Location;

class LocationController extends ActiveController
{
    public $modelClass = 'app\models\Location';
     public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];
}