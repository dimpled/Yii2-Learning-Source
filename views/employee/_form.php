<?php
/**
 * @author Satit Seethaphon<dixonsatit@gmail.com>
 * @link https://github.com/dimpled/Yii2-Learning/blob/master/tutorial/create-form.md
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;


use kartik\widgets\Select2;
use kartik\widgets\TypeaheadBasic;
use kartik\widgets\DepDrop;
use kartik\widgets\FileInput;

use app\models\Countries;
use app\models\Employee;
use app\models\Province;
use app\models\Amphur;
use app\models\District;

use yii\helpers\VarDumper;
//VarDumper::dump( $district,10,true);
/* @var $this yii\web\View */
/* @var $model app\models\Employee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee-form" >

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<?= $form->errorSummary($model); ?>

<div class="page-header">
  <h4>ข้อมูลส่วนตัว </h4>
</div>
 <?= $form->field($model, 'token_forupload')->hiddenInput()->label(false); ?>
<div class="row">
    <div class="col-xs-4 col-sm-2 col-md-2">
        <?= $form->field($model, 'title')->widget(TypeaheadBasic::classname(), [
                'data' =>  ['นาย','นาง','นางสาว'],
                'pluginOptions' => ['highlight'=>true],
            ]);
        ?>
    </div>
    <div class="col-xs-4 col-sm-5 col-md-5">
        <?= $form->field($model, 'name')->textInput(['maxlength' => 50]) ?>
    </div>
    <div class="col-xs-4 col-sm-5 col-md-5">
        <?= $form->field($model, 'surname')->textInput(['maxlength' => 50]) ?>
    </div>
</div>

<div class="row">
    <div class="col-xs-6 col-sm-4 col-md-4">
     <?= $form->field($model, 'sex')->inline()->radioList(Employee::itemAlias('sex')) ?>
    </div>

    <div class="col-xs-6 col-sm-4 col-md-4">
      <?= $form->field($model, 'birthday')->widget(DatePicker::classname(), [
        'language' => 'th',
        'dateFormat' => 'yyyy-MM-dd',
        'clientOptions'=>[
          'changeMonth'=>true,
          'changeYear'=>true,
        ],
        'options'=>['class'=>'form-control']
      ]) ?>
    </div>

    <div class="col-xs-12 col-sm-4 col-md-4">
      <?= $form->field($model, 'age')->textInput() ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-6 col-md-6">
      <?= $form->field($model, 'personal_id')->widget(\yii\widgets\MaskedInput::classname(), [
        'mask' => '9-9999-99999-999',
        'clientOptions'=>[
            'removeMaskOnSubmit'=>true //กรณีไม่ต้องการให้มันบันทึก format ลงไปด้วยเช่น 9-9999-99999-999 ก็จะเป็น 9999999999999
        ]
    ]) ?>
    </div>

    <div class="col-sm-6 col-md-6">
       <?= $form->field($model, 'marital')->dropdownList(Employee::itemAlias('marital'),[
            'prompt'=>'เลือกสถานะ'
       ]); ?>
    </div>
</div>


<div class="page-header">
  <h4>รายละเอียดตำแหน่งงาน </h4>
</div>

<div class="row">
    <div class="col-sm-4 col-md-4">
       <?= $form->field($model, 'position')->textInput() ?>
    </div>
    <div class="col-sm-4 col-md-4">
       <?= $form->field($model, 'salary')->textInput() ?>
    </div>
    <div class="col-sm-4 col-md-4">
       <?= $form->field($model, 'experience')->textInput() ?>
    </div>
</div>


<div class="page-header">
  <h4>ข้อมูลสำหรับการติดต่อ </h4>
</div>
<?= $form->field($model, 'address')->textInput() ?>
<div class="row">
    <div class="col-sm-4 col-md-4">
       <?= $form->field($model, 'province')->dropdownList(
            ArrayHelper::map(Province::find()->all(),
            'PROVINCE_ID',
            'PROVINCE_NAME'),
            [
                'id'=>'ddl-province',
                'prompt'=>'เลือกจังหวัด'
       ]); ?>
    </div>
    <div class="col-sm-4 col-md-4">
       <?= $form->field($model, 'amphur')->widget(DepDrop::classname(), [
            'options'=>['id'=>'ddl-amphur'],
            'data'=> $amphur,
            'pluginOptions'=>[
                'depends'=>['ddl-province'],
                'placeholder'=>'เลือกอำเภอ...',
                'url'=>Url::to(['/employee/get-amphur'])
            ]
        ]); ?>
    </div>
    <div class="col-sm-4 col-md-4">
      <?= $form->field($model, 'district')->widget(DepDrop::classname(), [
            'data' =>$district,
            'pluginOptions'=>[
                'depends'=>['ddl-province', 'ddl-amphur'],
                'placeholder'=>'เลือกตำบล...',
                'url'=>Url::to(['/employee/get-district'])
            ]
        ]); ?>
    </div>
</div>





    <div class="row">
    <div class="col-sm-4 col-md-4">
        <?= $form->field($model, 'zip_code')->widget(\yii\widgets\MaskedInput::classname(), [
            'mask' => '99999',
        ]) ?>
    </div>

    <div class="col-sm-4 col-md-4">
  <?= $form->field($model, 'countries')->widget(Select2::classname(), [
        'language' => 'de',
        'data' => ArrayHelper::map(Countries::find()->all(),'country_code','country_name'),
        'options' => ['placeholder' => 'เลือกประเทศ ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
    </div>

    <div class="col-sm-4 col-md-4">
       <?= $form->field($model, 'mobile_phone')->widget(\yii\widgets\MaskedInput::classname(), [
        'mask' => '99-9999-9999',
    ]) ?>
    </div>

</div>

<div class="row">
    <div class="col-sm-6 col-md-6">
       <?= $form->field($model, 'email')->textInput(['maxlength' => 150]) ?>
    </div>
    <div class="col-sm-6 col-md-6">
        <?= $form->field($model, 'website')->textInput(['maxlength' => 150]) ?>
    </div>
</div>

<div class="page-header">
<h4>ความสามารถ </h4>
</div>

    <?= $form->field($model, 'social')->inline()->checkboxList(Employee::itemAlias('social')) ?>

  <?= $form->field($model, 'skill')->widget(Select2::classname(), [
        'language' => 'de',
        'data' => Employee::itemAlias('skill'),
        'options' => ['multiple'=>true, 'placeholder' => 'เลือกความสามารถ ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>

    <?=  $form->field($model, 'resume')->widget(FileInput::classname(), [
    //'options' => ['accept' => 'image/*'],
    'pluginOptions' => [
         'initialPreview'=>empty($model->resume)?[]:[
            Yii::getAlias('@web').'/resumes/'.$model->resume,
         ],
        'allowedFileExtensions'=>['pdf'],
        'showPreview' => false,
        'showCaption' => true,
        'showRemove' => true,
        'showUpload' => false
     ]
    ]); ?>

<div class="form-group field-upload_files">
  <label class="control-label" for="upload_files[]"> อัพโหลดไฟล์ต่างๆ </label>
<div>
<?= FileInput::widget([
               'name' => 'upload_files[]',
               'options' => ['multiple' => true], //'accept' => 'image/*' หากต้องเฉพาะ image
                'pluginOptions' => [
                    'overwriteInitial'=>false,
                    'initialPreviewShowDelete'=>true,
                    'initialPreview'=> $initialPreview,
                    'initialPreviewConfig'=> $initialPreviewConfig,
                    'previewFileType' => 'any',
                    'uploadUrl' => Url::to(['/employee/upload']),
                    'uploadExtraData' => [
                        'request_id' => $model->token_forupload,
                    ],
                    'maxFileCount' => 100
                ]
            ]);
            ?>
</div>
</div>

<br>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => ($model->isNewRecord ? 'btn btn-success' : 'btn btn-primary').' btn-lg btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
