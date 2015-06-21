<?php
/**
 * @author Satit Seethaphon<dixonsatit@gmail.com>
 * @link https://github.com/dimpled/Yii2-Learning/blob/master/tutorial/create-form.md
 */

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Employee;
use app\models\Province;

echo Province::findOne(['PROVINCE_ID'=>12])->PROVINCE_NAME;

/* @var $this yii\web\View */
/* @var $model app\models\Employee */

$this->title = $model->emp_id;
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-view">

    <h1>View <?= Html::encode($this->title) ?></h1>

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
            //'emp_id',
            ['attribute'=>'sex','value'=>$model->sex===null?'':Employee::itemAlias('sex',$model->sex)],
            ['label'=>'ชื่อ-นามสกุล','value'=>$model->getFullname()],
            'fullName',
            // 'title',
            // 'name',
            // 'surname',
            'address:ntext',
            'zip_code',
            //'birthday',
             ['attribute'=>'birthday','format'=>'html','value'=>Yii::$app->formatter->asDate($model->birthday,'medium')],
            'email:email',
            'mobile_phone',          
            'position',
            'salary',          
            'website:url',
            'skill',
            'countries',
            'age',
            'experience',
            'personal_id',
            ['attribute'=>'sex','value'=>$model->marital===null?'':Employee::itemAlias('marital',$model->marital)],
            //Inverse Relations Model
            'provinces.PROVINCE_NAME',
            'amphurs.AMPHUR_NAME',
            'districts.DISTRICT_NAME',
            //เรียกแบบธรรมดา ไม่แนะนำ
            [
                'attribute'=>'province',
                'value'=>@Province::findOne(['PROVINCE_ID'=>$model->province])->PROVINCE_NAME
            ],
            //Virtual Attribute
            'provinceName',
            'amphurName',
            'districtName',

            'social',
             ['attribute'=>'resume','format'=>'html','value'=>!$model->resume?'':Html::a('ดาวน์โหลด', ['/employee/download','type'=>'resume','id'=>$model->emp_id])],
            'expire_date',
            'create_date',
            'modify_date',
        ],
    ]) ?>

</div>
