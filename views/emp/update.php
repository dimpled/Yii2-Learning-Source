<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Emp */

$this->title = 'Update Emp: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Emps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->emp_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="emp-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'amphur'=>$amphur,
        'district'=>$district
    ]) ?>

</div>
