<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\Arrayhelper;
use app\models\Province;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use yii\widgets\MaskedInput;
use kartik\widgets\DepDrop;

use kartik\widgets\Select2;
use app\models\Countries;
/* @var $this yii\web\View */
/* @var $model app\models\Emp */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="emp-form">

    <?php $form = ActiveForm::begin([

      ]); ?>

    <div class="row">
      <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
      </div>
      <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
      </div>
      <div class="col-lg-5 col-md-5 col-sm-6 col-xs-6">
        <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>
      </div>
    </div>

    <?= $form->field($model, 'sex')->inline()->radioList([
      '1'=>'ชาย',
      '2'=>'หญิง',
      '3'=>'ไม่ระบุ'
    ]) ?>

    <?= $form->field($model, 'personal_id')
    ->widget(MaskedInput::className(),[
      'mask'=>'99/9999-99-99-9',
    ]) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'zip_code')
    ->widget(MaskedInput::className(),[
      'mask'=>'99999',
    ]) ?>

    <?= $form->field($model, 'birthday')
    ->widget(MaskedInput::className(),[
      'mask'=>'99-99-9999',
      'options'=>[
        'placeholder'=>'กรอก วัน-เดือน-ปี พ.ศ.',
        'class'=>'form-control'
        ]
    ]) ?>
    <?= $form->field($model, 'email')->textInput([
      'maxlength' => true,
      'placeholder'=>'กรอกรูปแบบอีเมล'
      ]) ?>

    <?= $form->field($model, 'mobile_phone')
    ->widget(MaskedInput::className(),[
      'mask'=>'(99) 9999-9999',
    ]) ?>

    <div class="row">
      <div class="col-lg-4">
        <?= $form->field($model, 'province')->dropdownList(
        ArrayHelper::map(
          Province::find()->all(),
            'PROVINCE_ID',
            'PROVINCE_NAME'
          ),[
              'id'=>'ddl-province',
              'prompt'=>'เลือกจังหวัด'
        ])?>
      </div>
      <div class="col-lg-4">
        <?= $form->field($model, 'amphur')->widget(DepDrop::classname(), [
             'options'=>['id'=>'ddl-amphur'],
             'data'=> $amphur,
             'pluginOptions'=>[
                 'depends'=>['ddl-province'],
                 'placeholder'=>'เลือกอำเภอ...',
                 'url'=>Url::to(['/emp/get-amphur'])
             ]
         ]); ?>
      </div>
      <div class="col-lg-4">
        <?= $form->field($model, 'district')->widget(DepDrop::classname(), [
             'options'=>['id'=>'ddl-district'],
             'data'=> $district,
             'pluginOptions'=>[
                 'depends'=>['ddl-province', 'ddl-amphur'],
                 'placeholder'=>'เลือกตำบล...',
                 'url'=>Url::to(['/emp/get-district'])
             ]
         ]); ?>

      </div>
    </div>

    <?= $form->field($model, 'modify_date')->textInput() ?>

    <?= $form->field($model, 'create_date')->textInput() ?>

    <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'salary')->textInput() ?>

    <?= $form->field($model, 'expire_date')->textInput() ?>

    <?= $form->field($model, 'website')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'skill')->textInput(['maxlength' => true]) ?>
    use kartik\widgets\Select2;
    use app\models\Countries;
    <?= $form->field($model, 'countries')
        ->widget(Select2::className(),[
          'data'=> ArrayHelper::map(Countries::find()->all(),
          'country_code','country_name'),
          'options' => ['placeholder' => 'เลือกประเทศ ...'],
          'pluginOptions' => [
              'allowClear' => true
          ],
    ]); ?>

    <?= $form->field($model, 'age')->textInput() ?>

    <?= $form->field($model, 'experience')->textInput(['maxlength' => true]) ?>



    <?= $form->field($model, 'marital')->textInput() ?>


    <?= $form->field($model, 'social')->inline()->checkboxList([
      1=>'Facebook',
      2=>'Google+',
      3=>'Twiter'
    ]) ?>











    <?= $form->field($model, 'resume')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'token_forupload')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'count_download_resume')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
