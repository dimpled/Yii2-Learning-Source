<?php
/**
 * @author Satit Seethaphon<dixonsatit@gmail.com>
 * @link https://github.com/dimpled/Yii2-Learning/blob/master/tutorial/create-form.md
 */

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EmployeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Employees';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<i class="glypicon glyphicon-plus"> </i> Create Employee', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'emp_id',

            'title',
            'name',
            'surname',
            'address:ntext',
            // 'zip_code',
            // 'birthday',
            // 'email:email',
            // 'mobile_phone',
            // 'modify_date',
            // 'create_date',
            // 'position_id',
            // 'salary',
            // 'expire_date',
            // 'website',
            // 'skill',
            [

              'attribute'=>'skill'
            ],
            [
              'class' => 'yii\grid\ActionColumn',
              'buttonOptions'=>['class'=>'btn btn-default'],
              'template'=>'<div class="btn-group btn-group-sm text-center" role="group">{copy} {view} {update} {delete} </div>',
              'options'=> ['style'=>'width:150px;'],
              'buttons'=>[
                'copy' => function($url,$model,$key){
                    return Html::a('<i class="glyphicon glyphicon-duplicate"></i>',$url,['class'=>'btn btn-default']);
                  }
                ]
            ],
            // [
            //     'class' => 'yii\grid\ActionColumn',
            //     'header'=>'Action',
            //     //'template'=>'{view}',
            //     'contentOptions'=>[
            //         'noWrap' => true
            //     ]
            // ],
            // [
            //     'class' => 'yii\grid\ActionColumn',
            //     'header'=>'Action',
            //     'options'=> [
            //       'style'=>'width:100px;'
            // ]
                // 'contentOptions'=>[
                //     'noWrap' => true
                // ]
            //],
            // [
            //     'class' => 'yii\grid\ActionColumn',
            //     'options'=>['style'=>'width:120px;'],
            //     'template'=>'<div class="btn-group btn-group-sm" role="group" aria-label="...">{view}{update}{delete}</div>',
            //     'buttons'=>[
            //         'view'=>function($url,$model,$key){
            //             return Html::a('<i class="glyphicon glyphicon-eye-open"></i>',$url,['class'=>'btn btn-default']);
            //         },
            //         'update'=>function($url,$model,$key){
            //             return Html::a('<i class="glyphicon glyphicon-pencil"></i>',$url,['class'=>'btn btn-default']);
            //         },
            //         'delete'=>function($url,$model,$key){
            //              return Html::a('<i class="glyphicon glyphicon-trash"></i>', $url,[
            //                     'title' => Yii::t('yii', 'Delete'),
            //                     'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
            //                     'data-method' => 'post',
            //                     'data-pjax' => '0',
            //                     'class'=>'btn btn-default'
            //                     ]);
            //         }
            //     ]
            // ],
        ],
    ]); ?>

</div>
