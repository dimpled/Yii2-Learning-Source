<?php
/**
 * @author Satit Seethaphon<dixonsatit@gmail.com>
 * @link https://github.com/dimpled/Yii2-Learning/blob/master/tutorial/create-form.md
 */

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Employee */

$this->title = 'Update Employee: ' . ' ' . $model->emp_id;
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->getFullname(), 'url' => ['view', 'id' => $model->emp_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="employee-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
         'amphur'=> $amphur,
         'district' =>$district,
         'initialPreview'=>$initialPreview,
         'initialPreviewConfig'=>$initialPreviewConfig
    ]) ?>

</div>
