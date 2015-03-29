<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PhotoLibrarySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Photo Libraries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photo-library-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Photo Library', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'event_name',
            'customer_name',
            'location',
            'start_date',
            // 'province',
            
            // 'customer_mobile_phone',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
