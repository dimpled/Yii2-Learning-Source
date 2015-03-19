<?php
/**
 * @author Satit Seethaphon<dixonsatit@gmail.com>
 * @link https://github.com/dimpled/Yii2-Learning/blob/master/tutorial/create-form.md
 */

use yii\helpers\Html;
use app\models\Employee;

/* @var $this yii\web\View */
/* @var $model app\models\Employee */

$this->title = 'Create Employee';
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="employee-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'amphur'=> $amphur,
        'district' =>$district,
        'initialPreview'=>[],
        'initialPreviewConfig'=>[]
    ]) ?>

</div>
