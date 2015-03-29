<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\Uploads;

/* @var $this yii\web\View */
/* @var $model app\models\PhotoLibrary */

$this->title = $model->event_name;
$this->params['breadcrumbs'][] = ['label' => 'Photo Libraries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photo-library-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'event_name',
            'detail:ntext',
            'start_date:date',
            'end_date:date',
            'location',
            ['attribute'=>'province_id','value'=>@$model->province->PROVINCE_NAME],
            'customer_name',
            'customer_mobile_phone',
        ],
    ]) ?>
    
<div class="panel panel-default">
  <div class="panel-body">
     <?= dosamigos\gallery\Gallery::widget(['items' => $model->getThumbnails($model->ref,$model->event_name)]);?>
  </div>
</div>
    

</div>
