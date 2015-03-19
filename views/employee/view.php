<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Employee */

$this->title = $model->emp_id;
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->emp_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->emp_id], [
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
            'emp_id',
            'sex',
            'title',
            'name',
            'surname',
            'address:ntext',
            'zip_code',
            'birthday',
            'email:email',
            'mobile_phone',
            'modify_date',
            'create_date',
            'position',
            'salary',
            'expire_date',
            'website:url',
            'skill',
            'countries',
            'age',
            'experience',
            'personal_id',
            'marital',
            'province',
            'amphur',
            'district',
            'social',
        ],
    ]) ?>

</div>
