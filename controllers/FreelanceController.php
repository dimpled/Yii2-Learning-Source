<?php

namespace app\controllers;

use Yii;
use app\models\Freelance;
use app\models\FreelanceSearch;
use app\models\Uploads;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\helpers\html;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;

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

            $this->CreateDir($model->ref);
            $model->covenant = $this->uploadSingleFile($model);
            $model->docs = $this->uploadMultipleFile($model);

            if($model->save()){
                 return $this->redirect(['view', 'id' => $model->id]);
            }

        } else {
             $model->ref = substr(Yii::$app->getSecurity()->generateRandomString(),10);
        }

        return $this->render('create', [
            'model' => $model,
        ]);       
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

        $tempCovenant = $model->covenant;
        $tempDocs     = $model->docs;
        if ($model->load(Yii::$app->request->post())) {

            $this->CreateDir($model->ref);
            $model->covenant = $this->uploadSingleFile($model,$tempCovenant);
            $model->docs = $this->uploadMultipleFile($model,$tempDocs);

            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model
        ]);
    }

    /**
     * Deletes an existing Freelance model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        //remove upload file & data
        $this->removeUploadDir($model->ref);
        Uploads::deleteAll(['ref'=>$model->ref]);

        $model->delete();

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

    public function actionDeletefile($id,$field,$fileName){
        $status = ['success'=>false];
        if(in_array($field, ['docs','covenant'])){
            $model = $this->findModel($id);
            $files =  Json::decode($model->{$field});
            if(array_key_exists($fileName, $files)){
                if($this->deleteFile('file',$model->ref,$fileName)){
                    $status = ['success'=>true];
                    unset($files[$fileName]);
                    $model->{$field} = Json::encode($files);
                    $model->save();
                }
            }
        }
        echo json_encode($status);
    }

    private function deleteFile($type='file',$ref,$fileName){
        if(in_array($type, ['file','thumbnail'])){
            if($type==='file'){
               $filePath = Freelance::getUploadPath().$ref.'/'.$fileName;
            } else {
               $filePath = Freelance::getUploadPath().$ref.'/thumbnail/'.$fileName;
            }
            @unlink($filePath);
            return true;
        }
        else{
            return false;
        }
    }

    public function actionDownload($id,$file,$file_name){
        $model = $this->findModel($id);
         if(!empty($model->ref) && !empty($model->covenant)){
                Yii::$app->response->sendFile($model->getUploadPath().'/'.$model->ref.'/'.$file,$file_name);
        }else{
            $this->redirect(['/freelance/view','id'=>$id]);
        }
    }

    /**
     * Upload & Rename file
     * @return mixed
     */
    private function uploadSingleFile($model,$tempFile=null){
        $file = [];
        $json = '';
        try {
             $UploadedFile = UploadedFile::getInstance($model,'covenant');
             if($UploadedFile !== null){
                 $oldFileName = $UploadedFile->basename.'.'.$UploadedFile->extension;
                 $newFileName = md5($UploadedFile->basename.time()).'.'.$UploadedFile->extension;
                 $UploadedFile->saveAs(Freelance::UPLOAD_FOLDER.'/'.$model->ref.'/'.$newFileName);
                 $file[$newFileName] = $oldFileName;
                 $json = Json::encode($file);
             }else{
                $json=$tempFile;
             }
        } catch (Exception $e) {
            $json=$tempFile;
        }     
        return $json ;
    }

    private function uploadMultipleFile($model,$tempFile=null){
             $files = [];
             $json = '';
             $tempFile = Json::decode($tempFile);
             $UploadedFiles = UploadedFile::getInstances($model,'docs');
             if($UploadedFiles!==null){
                foreach ($UploadedFiles as $file) {
                    try {   $oldFileName = $file->basename.'.'.$file->extension;
                            $newFileName = md5($file->basename.time()).'.'.$file->extension;
                            $file->saveAs(Freelance::UPLOAD_FOLDER.'/'.$model->ref.'/'.$newFileName);
                            $files[$newFileName] = $oldFileName ;
                    } catch (Exception $e) {
                       
                    }
                }
                $json = json::encode(ArrayHelper::merge($tempFile,$files));
             }else{
                $json = $tempFile;
             }          
            return $json;
    }

   

    private function CreateDir($folderName){
        if($folderName != NULL){
            $basePath = Freelance::getUploadPath();
            if(BaseFileHelper::createDirectory($basePath.$folderName,0777)){
                BaseFileHelper::createDirectory($basePath.$folderName.'/thumbnail',0777);
            }
        }
        return;
    }

    private function removeUploadDir($dir){
        BaseFileHelper::removeDirectory(Freelance::getUploadPath().$dir);
    }



}
