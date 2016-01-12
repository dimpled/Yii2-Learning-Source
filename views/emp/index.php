<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EmpSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Emps';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emp-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Emp', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'provinceName',
            'emp_id',
            'sex',
            'title',
            'name',
            'surname',
            // 'address:ntext',
            // 'zip_code',
            // 'birthday',
            // 'email:email',
            // 'mobile_phone',
            // 'modify_date',
            // 'create_date',
            // 'position',
            // 'salary',
            // 'expire_date',
            // 'website',
            // 'skill',
            // 'countries',
            // 'age',
            // 'experience',
            // 'personal_id',
            // 'marital',
            // 'province',
            // 'amphur',
            // 'district',
            // 'social',
            // 'resume',
            // 'token_forupload',
            // 'count_download_resume',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
