<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Freelance */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="freelance-form">

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
   
<?= $form->errorSummary($model); ?>

     <?= $form->field($model, 'ref')->hiddenInput()->label(false); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>

    <?php // $form->field($model, 'covenant')->textInput(['maxlength' => 100]) ?>
    <?= $form->field($model, 'covenant')->widget(FileInput::classname(), [
    //'options' => ['accept' => 'image/*'],
    'pluginOptions' => [
        'initialPreview'=>[],
        'allowedFileExtensions'=>['pdf'],
        'showPreview' => false,
        'showCaption' => true,
        'showRemove' => true,
        'showUpload' => false
     ]
    ]); ?>

    <?php //$form->field($model, 'docs')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'docs[]')->widget(FileInput::classname(), [
    'options' => [
        //'accept' => 'image/*',
        'multiple' => true
    ],
    'pluginOptions' => [
        'initialPreview'=>[],
        'allowedFileExtensions'=>['pdf','doc','docx','xls','xlsx'],
        'showPreview' => true,
        'showCaption' => true,
        'showRemove' => true,
        'showUpload' => false
     ]
    ]); ?>
    <div class="row">
        <div class="col-sm-4 col-md-4"> <?= $form->field($model, 'start_date')->textInput() ?></div> 
        <div class="col-sm-4 col-md-4"><?= $form->field($model, 'end_date')->textInput() ?></div>
        <div class="col-sm-4 col-md-4"><?= $form->field($model, 'succes_date')->textInput() ?></div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('<i class="glyphicon glyphicon-plus"></i> '.($model->isNewRecord ? 'Create' : 'Update'), ['class' => ($model->isNewRecord ? 'btn btn-success' : 'btn btn-primary').' btn-lg btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
