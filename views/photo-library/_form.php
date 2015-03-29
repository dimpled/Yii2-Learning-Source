<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use app\models\Province;
use kartik\widgets\Select2;
use kartik\widgets\FileInput;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\PhotoLibrary */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="photo-library-form">

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?=$form->errorSummary($model) ?>

    <?= $form->field($model, 'ref')->hiddenInput(['maxlength' => 50])->label(false); ?>

    <?= $form->field($model, 'event_name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'detail')->textarea(['rows' => 3]) ?>

     <div class="row">
            <div class="col-sm-6 col-md-6">
             <?= $form->field($model, 'start_date')->widget(
            DatePicker::className(), [
                'language' => 'th',
                 'options' => ['placeholder' => 'Select issue date ...'],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true
                ]
        ]);?>
            </div>
            <div class="col-sm-6 col-md-6">
             <?= $form->field($model, 'end_date')->widget(
            DatePicker::className(), [
                'language' => 'th',
                 'options' => ['placeholder' => 'Select issue date ...'],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true
                ]
        ]);?>
            </div>
    </div>
    
    <?= $form->field($model, 'location')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'province_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(province::find()->all(),'PROVINCE_ID','PROVINCE_NAME'),
        'options' => ['placeholder' => 'เลือกจังหวัด ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
    <div class="row">
        <div class="col-sm-6 col-md-6">
            <?= $form->field($model, 'customer_name')->textInput(['maxlength' => 150]) ?>
        </div>
        <div class="col-sm-6 col-md-6">
            <?= $form->field($model, 'customer_mobile_phone')->textInput(['maxlength' => 20]) ?>
        </div>
    </div>

   <div class="form-group field-upload_files">
      <label class="control-label" for="upload_files[]"> ภาพถ่าย </label>
    <div>
    <?= FileInput::widget([
                   'name' => 'upload_ajax[]',
                   'options' => ['multiple' => true,'accept' => 'image/*'], //'accept' => 'image/*' หากต้องเฉพาะ image
                    'pluginOptions' => [
                        'overwriteInitial'=>false,
                        'initialPreviewShowDelete'=>true,
                       'initialPreview'=> $initialPreview,
                        'initialPreviewConfig'=> $initialPreviewConfig,
                        'uploadUrl' => Url::to(['/photo-library/upload-ajax']),
                        'uploadExtraData' => [
                            'ref' => $model->ref,
                        ],
                        'maxFileCount' => 100
                    ]
                ]);
    ?>
    </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => ($model->isNewRecord ? 'btn btn-success' : 'btn btn-primary').' btn-lg btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
