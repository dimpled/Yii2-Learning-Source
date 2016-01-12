<?php

namespace app\controllers;

use app\models\Province;

class QueryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $pie = Province::find()->loadPieChartData();

        return $this->render('index',[
          'provinces'=>$pie['provinces'],
          'provinces_pie'=>$pie['pieData']
        ]);
    }
}
