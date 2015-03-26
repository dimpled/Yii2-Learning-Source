<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FreelanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Freelances';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="freelance-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a('Create Freelance', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
             'start_date',
             'end_date',
            //'description:ntext',
            //'covenant',
            // 'docs:ntext',
            
            // 'success_date',
            //'create_date:date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
