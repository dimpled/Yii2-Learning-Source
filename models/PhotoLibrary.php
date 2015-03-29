<?php

namespace app\models;

use Yii;
use yii\helpers\Url;
use app\models\Province;
/**
 * This is the model class for table "photo_library".
 *
 * @property integer $id
 * @property string $ref
 * @property string $event_name
 * @property string $detail
 * @property string $start_date
 * @property string $end_date
 * @property string $location
 * @property string $province_id
 * @property string $customer_name
 * @property string $customer_mobile_phone
 */
class PhotoLibrary extends \yii\db\ActiveRecord
{
    const UPLOAD_FOLDER='photolibrarys';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'photo_library';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['event_name','detail'],'required'],
            [['detail'], 'string'],
            [['start_date', 'end_date'], 'safe'],
            [['ref'], 'string', 'max' => 50],
            [['event_name', 'location'], 'string', 'max' => 255],
            [['province_id'], 'integer'],
            [['customer_name'], 'string', 'max' => 150],
            [['customer_mobile_phone'], 'string', 'max' => 20],
            [['ref'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ref' => 'เลข fk กับ upload ใช้กับ upload ajax',
            'event_name' => 'ชื่องาน',
            'detail' => 'รายละเอียด',
            'start_date' => 'วันที่เริ่มถ่ายภาพ',
            'end_date' => 'วันที่ถ่ายภาพเสร็จ',
            'location' => 'สถานที่',
            'province_id' => 'จังหวัด',
            'customer_name' => 'ชื่อลูกค้า',
            'customer_mobile_phone' => 'เบอร์โทร',
        ];
    }

    public static function getUploadPath(){
        return Yii::getAlias('@webroot').'/'.self::UPLOAD_FOLDER.'/';
    }

    public static function getUploadUrl(){
        return Url::base(true).'/'.self::UPLOAD_FOLDER.'/';
    }

    public function getThumbnails($ref,$event_name){
         $uploadFiles   = Uploads::find()->where(['ref'=>$ref])->all();
         $preview = [];
        foreach ($uploadFiles as $file) {
            $preview[] = [
                'url'=>self::getUploadUrl(true).$ref.'/'.$file->real_filename,
                'src'=>self::getUploadUrl(true).$ref.'/thumbnail/'.$file->real_filename,
                'options' => ['title' => $event_name]
            ];
        }
        return $preview;
    }

    public function getProvince()
    {
      return $this->hasOne(Province::className(),['PROVINCE_ID'=>'province_id']);
    }

}
