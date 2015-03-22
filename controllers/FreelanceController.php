<?php

namespace app\Controllers;

use Yii;
use app\models\Freelance;
use app\models\FreelanceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\web\UploadedFile;

/**
 * FreelanceController implements the CRUD actions for Freelance model.
 */
class FreelanceController extends Controller
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
     * Lists all Freelance models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FreelanceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Freelance model.
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
     * Creates a new Freelance model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Freelance();

        if ($model->load(Yii::$app->request->post()) ) {

            $model->covenant = UploadedFile::getInstance($model,'covenant');
            if( $model->covenant && $model->validate()){
                $model->covenant = $this->uploadSingleFile($model->covenant);
            }

            $model->docs     = UploadedFile::getInstances($model,'docs');
            if( $model->docs && $model->validate()){
                $model->docs = $this->uploadMultipleFile($model->docs);
            }

            if($model->save()){
                 return $this->redirect(['view', 'id' => $model->id]);
            }
        } 

        return $this->render('create', [
            'model' => $model,
        ]);
        
    }

    /**
     * Upload & Rename file
     */
    private function uploadSingleFile(UploadedFile $UploadedFile){
        try {
             $newFileName = md5($UploadedFile->basename.time()).'.'.$UploadedFile->extension;
             $UploadedFile->saveAs('freelance/'.$newFileName);
        } catch (Exception $e) {
            $newFileName = '';
        }     
        return $newFileName;
    }

    private function uploadMultipleFile($UploadedFiles){
        $files = [];
        try {
             foreach ($UploadedFiles as $file) {
                    $newFileName = md5($file->basename.time()).'.'.$file->extension;
                    $file->saveAs('freelance/'.$newFileName);
                    $files[] = $newFileName ;
             }
        } catch (Exception $e) {
            $files = [];
        }
        return implode(',', $files);
    }





    /**
     * Updates an existing Freelance model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Freelance model.
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
     * Finds the Freelance model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Freelance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Freelance::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
