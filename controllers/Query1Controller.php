<?php

namespace app\controllers;
use app\models\Province;

class Query1Controller extends \yii\web\Controller
{
    public function actionIndex()
    {
        $data =  Province::find()->getDataFromSql();
        return $this->render('index',[
          'data'=>$data
        ]);
    }

}
