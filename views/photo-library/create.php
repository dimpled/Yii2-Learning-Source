<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PhotoLibrary */

$this->title = 'Create Photo Library';
$this->params['breadcrumbs'][] = ['label' => 'Photo Libraries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photo-library-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
         'initialPreview'=>[],
        'initialPreviewConfig'=>[]
    ]) ?>

</div>
