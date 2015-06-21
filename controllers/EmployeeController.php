<?php
/**
 * @author Satit Seethaphon<dixonsatit@gmail.com>
 * @link https://github.com/dimpled/Yii2-Learning/blob/master/tutorial/create-form.md
 */

namespace app\controllers;

use Yii;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseFileHelper;

use app\models\Employee;
use app\models\EmployeeSearch;
use app\models\Province;
use app\models\Amphur;
use app\models\District;
use app\models\Uploads;

use yii\helpers\Html;
use yii\helpers\Url;

/**
 * EmployeeController implements the CRUD actions for Employee model.
 */
class EmployeeController extends Controller
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
     * Lists all Employee models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EmployeeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Employee model.
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
     * Creates a new Employee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Employee();
        $model->token_forupload = substr(Yii::$app->getSecurity()->generateRandomString(),10);

        if ($model->load(Yii::$app->request->post())) {
            
            $this->Uploads(false);

            $model->resume = UploadedFile::getInstance($model, 'resume');
            
            if ($model->resume && $model->validate()) {
                    $fileName = md5($model->resume->baseName.time()).'.'.$model->resume->extension;
                    $image = $model->resume;
                    $model->resume  = $fileName;  
                    $image->saveAs('resumes/' . $fileName);    
                    if($model->save())  
                    {
                        return $this->redirect(['view', 'id' => $model->emp_id]);
                    }   
             }else if($model->save()){
                return $this->redirect(['view', 'id' => $model->emp_id]);
             }
        }

        return $this->render('create', [
            'model' => $model,
            'amphur'=> [],
            'district' =>[]
        ]);
        
    }

    /**
     * Updates an existing Employee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model          = $this->findModel($id);

        $amphur         = ArrayHelper::map($this->getAmphur($model->province),'id','name');
        $district       = ArrayHelper::map($this->getDistrict($model->amphur),'id','name');

        $model->social  = $model->getArray($model->social);
        $model->skill  = $model->getArray($model->skill);

        $tempResume     = $model->resume;

        list($initialPreview,$initialPreviewConfig) = $this->getInitialPreview($model->token_forupload);

        if ($model->load(Yii::$app->request->post())) {

            $this->Uploads(false);

            $model->resume  = UploadedFile::getInstance($model, 'resume');

            if ($model->resume && $model->validate()) {
                    $fileName       = md5($model->resume->baseName.time()).'.'.$model->resume->extension;
                    $image          = $model->resume;
                    $model->resume  = $fileName;  
                    $image->saveAs('resumes/' . $fileName);   
                    if($model->save())  
                    {
                        return $this->redirect(['view', 'id' => $model->emp_id]);
                    }   
             }else {
                $model->resume = $tempResume;
                if($model->save()){
                     return $this->redirect(['view', 'id' => $model->emp_id]);
                }
             }
        }

        return $this->render('update', [
            'model' => $model,
            'amphur'=> $amphur,
            'district' =>$district,
            'initialPreview'=>$initialPreview,
            'initialPreviewConfig'=>$initialPreviewConfig

        ]);
    }


    /**
     * Deletes an existing Employee model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        //remove upload file & data
        $this->removeUploadDir($model->token_forupload);
        Uploads::deleteAll(['ref'=>$model->token_forupload]);
        // remove resume file
        $resume  = Employee::getResumePath().'/'.$model->resume;
        @unlink($resume);

        $model->delete();
        

        return $this->redirect(['index']);
    }

    /**
     * Finds the Employee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Employee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Employee::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionGetAmphur() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $province_id = $parents[0];
                $out = $this->getAmphur($province_id);
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function actionGetDistrict() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $province_id = empty($ids[0]) ? null : $ids[0];
            $amphur_id = empty($ids[1]) ? null : $ids[1];
            if ($province_id != null) {
               $data = $this->getDistrict($amphur_id);      
               echo Json::encode(['output'=>$data, 'selected'=>'']);
               return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    protected function getAmphur($id){
        $datas = Amphur::find()->where(['PROVINCE_ID'=>$id])->all(); 
        return $this->MapData($datas,'AMPHUR_ID','AMPHUR_NAME');
    }

    protected function getDistrict($id){
        $datas = District::find()->where(['AMPHUR_ID'=>$id])->all(); 
        return $this->MapData($datas,'DISTRICT_ID','DISTRICT_NAME');
    }

    protected function MapData($datas,$fieldId,$fieldName){
        $obj = [];
        foreach ($datas as $key => $value) {
            array_push($obj, ['id'=>$value->{$fieldId},'name'=>$value->{$fieldName}]);
        }
        return $obj;
    }


/*|******************************************************************************************|
  |==================================== Upload File =========================================|
/*|******************************************************************************************|*/
      public function actionDownload($type,$id){
        $model = $this->findModel($id);
        if($type==='resume'){
            Yii::$app->response->sendFile($model->getResumePath().'/'.$model->resume);
            $model->count_download_resume +=1;
            $model->save();
        }
        
      }

      public function actionDeletefile(){

        $model = Uploads::findOne(Yii::$app->request->post('key'));
        if($model!==NULL){
            $filename  = Employee::getUploadPath().'/'.$model->ref.'/'.$model->real_filename;
            $thumbnail = Employee::getUploadPath().'/'.$model->ref.'/thumbnail/'.$model->real_filename;
            if($model->delete()){
                @unlink($filename);
                @unlink($thumbnail);
                echo json_encode(['success'=>true]);
            }else{
                echo json_encode(['success'=>false]);
            }
        }else{
          echo json_encode(['success'=>false]);  
        }
      }

      public function actionUpload()
      {
           $this->Uploads(true);
      }

      private function removeUploadDir($dir){
        BaseFileHelper::removeDirectory(Employee::getUploadPath().'/'.$dir);
      }

      private function Uploads($isAjax=false) {
             if (Yii::$app->request->isPost) {
                $images = UploadedFile::getInstancesByName('upload_files');
                if ($images) {

                    if($isAjax===true){
                        $requestId =Yii::$app->request->post('request_id');
                    }else{
                        $emp = Yii::$app->request->post('Employee');
                        $requestId = $emp['token_forupload'];
                    }
                   
                    $this->CreateDir($requestId);

                    foreach ($images as $file){
                        $fileName       = $file->baseName . '.' . $file->extension;
                        $realFileName   = md5($file->baseName.time()) . '.' . $file->extension;
                        $savePath       = Employee::UPLOAD_PATH.'/'.$requestId.'/'. $realFileName;
                        if($file->saveAs($savePath)){

                            if($this->isImage(Url::base(true).'/'.$savePath)){
                                 $this->createThumbnail($requestId,$realFileName);
                            }
                          
                            $model                  = new Uploads;
                            $model->ref             = $requestId;
                            $model->file_name       = $fileName;
                            $model->real_filename   = $realFileName;
                            $model->save();

                            if($isAjax===true){
                                echo json_encode(['success' => 'true']);
                            }
                            
                        }else{
                            if($isAjax===true){
                                echo json_encode(['success'=>'false','eror'=>$file->error]);
                            }
                        }
                        
                    }
                }
            }
        }
        
        private function CreateDir($folderName){
            if($folderName!=NULL){
                $basePath = Employee::getUploadPath().'/';
                if(BaseFileHelper::createDirectory($basePath.$folderName,0777)){
                    BaseFileHelper::createDirectory($basePath.$folderName.'/thumbnail',0777);
                }
            }
            return;
        }

        private function createThumbnail($folderName,$fileName,$width=250){
          $uploadPath   = Employee::getUploadPath().'/'.$folderName.'/'; 
          $file         = $uploadPath.$fileName;
          $image        = Yii::$app->image->load($file);

          $image->resize($width);
          $image->save($uploadPath.'thumbnail/'.$fileName);
          return;
        }

        private function getInitialPreview($token_forupload) {
            $datas = Uploads::find()->where(['ref'=>$token_forupload])->all();
            $initialPreview = [];
            $initialPreviewConfig = [];
            foreach ($datas as $key => $value) {
                array_push($initialPreview, $this->getTemplatePreview($value));
                array_push($initialPreviewConfig, [
                    'caption'=> $value->file_name,
                    'width'  => '120px',
                    'url'    => Url::to(['/employee/deletefile']),
                    'key'    => $value->upload_id
                ]);
            }
            return  [$initialPreview,$initialPreviewConfig];
        }

        private function getTemplatePreview(Uploads $model){     
            $filePath = Employee::getUploadUrl().'/'.$model->ref.'/thumbnail/'.$model->real_filename;
            $isImage  = $this->isImage($filePath);
            if($isImage){
                $file = Html::img($filePath,['class'=>'file-preview-image', 'alt'=>$model->file_name, 'title'=>$model->file_name]);
            }else{
                $file =  "<div class='file-preview-other'> " .
                         "<h2><i class='glyphicon glyphicon-file'></i></h2>" .
                         "</div>";
            }
            return $file;
        }

        public function isImage($filePath){
            return @is_array(getimagesize($filePath)) ? true : false;
        }
}
