<?php

namespace app\controllers;

use Yii;
use yii\helpers\Html;

class FlashMessageController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSave($id=0)
    {
       if($id==1){
       	Yii::$app->getSession()->setFlash('success', [
		    'type' => 'danger',
		    'duration' => 10000,
		    'icon' => 'fa fa-users',
		    'message' => 'บันทึกข้อมูลเสร็จเรียบร้อย',
		    'title' => 'title',
		    'positonY' => 'top',
		    'positonX' => 'right'
		]);
		$this->redirect(['/flash-message/index']);
       }

       return $this->render('save');
    }

}
