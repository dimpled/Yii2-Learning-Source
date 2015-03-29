<?php
/* @var $this yii\web\View */
$this->title = 'My Yii Application';
use yii\helpers\Html;
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Yii 2 Learning</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="https://github.com/dimpled/Yii2-Learning">Tutorial</a>
        <a class="btn btn-lg btn-success" href="https://github.com/dimpled/Yii2-Learning-Source">Download Source Code</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Getting Started</h2>

                <ul>
                    <li><a href="https://github.com/dimpled/Yii2-Learning/blob/master/Chapter%201/Installation.md">Install</a></li>
                </ul>

               
            </div>
            <div class="col-lg-4">
                <h2>Widget</h2>

               <ul>
                   <li>
                       <?= Html::a('การติดตั้ง GridView + ExportMenu',['countries/index']); ?>
                   </li>
                   <li>
                       <?= Html::a('ใส่ Button Group ให้กับ ActionColumn ใน GridView',['countries/grid-button']); ?>

                   </li>

               </ul>

                
            </div>
            <div class="col-lg-4">
                <h2>Tutorial</h2>
                <ul>
                   <li><?= Html::a('การสร้าง from และการ upload',['/employee/index']); ?></li>
                   <li><?= Html::a('การสร้าง web service ',['/location']); ?></li>
                   <li><?= Html::a('การสร้าง Upload File เก็บข้อมูลด้วย json ',['/freelance']); ?></li>
                    <li><?= Html::a('สร้างฟอร์ม Upload Files ด้วย AJAXเก็บข้อมูลด้วย json ',['/photo-library']); ?></li>
               </ul>
            </div>
        </div>

    </div>
</div>
