<?php

namespace app\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use app\models\Emp;
use app\models\Amphur;
use app\models\District;
use app\models\EmpSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EmpController implements the CRUD actions for Emp model.
 */
class EmpController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Emp models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EmpSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Emp model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Emp model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Emp();

        if ($model->load(Yii::$app->request->post())
        && $model->validate()) {
            $model->social =
            is_array($model->social) ? implode(',', $model->social) : '';
            $model->save();
            return $this->redirect(['view', 'id' => $model->emp_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'amphur'=> [],
                'district'=>[]
            ]);
        }
    }

    /**
     * Updates an existing Emp model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $amphur = ArrayHelper::map(
          $this->getAmphur($model->province),
          'AMPHUR_ID',
          'AMPHUR_NAME'
        );
        $district = ArrayHelper::map(
        $this->getDistrict($model->amphur),
          'DISTRICT_ID',
          'DISTRICT_NAME'
        );

        $model->social = explode(',', $model->social);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->social =
            is_array($model->social) ? implode(',', $model->social) : '';
            $model->save();
            return $this->redirect(['view', 'id' => $model->emp_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'amphur'=> $amphur,
                'district'=>$district
            ]);
        }
    }

    /**
     * Deletes an existing Emp model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Emp model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Emp the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Emp::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGetAmphur(){
      $amphur = [];
      if(($province_id = Yii::$app->request->post('depdrop_parents'))){
        $amphur = $this->getAmphur($province_id[0]);
      }
      $output = $this->MapData($amphur,'AMPHUR_ID','AMPHUR_NAME');
      echo Json::encode(['output'=>$output, 'selected'=>'']);
    }
    public function getAmphur($province_id){
      return Amphur::find()->where([
         'PROVINCE_ID'=>$province_id
      ])->all();
    }
    public function actionGetDistrict(){
      $amphur = [];
      if(($amphur_id =
      Yii::$app->request->post('depdrop_parents'))){
        $amphur = $this->getDistrict($amphur_id[1]);
      }
      $output = $this->MapData($amphur,'DISTRICT_ID','DISTRICT_NAME');
      echo Json::encode(['output'=>$output, 'selected'=>'']);
    }
    public function getDistrict($amphur_id){
      return District::find()->where([
         'AMPHUR_ID'=>$amphur_id
      ])->all();
    }

    protected function MapData($datas,$fieldId,$fieldName){
        $obj = [];
        foreach ($datas as $key => $value) {
            array_push($obj, [
              'id'=>$value->{$fieldId},
              'name'=>$value->{$fieldName}
              ]);
        }
        return $obj;
    }

















}
