<?php
/**
 * @author Satit Seethaphon<dixonsatit@gmail.com>
 * @link https://github.com/dimpled/Yii2-Learning/blob/master/tutorial/create-form.md
 */

namespace app\models;

use Yii;
use yii\helpers\Url;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use app\models\Province;
use app\models\District;
use app\models\Amphur;

/**
 * This is the model class for table "employee".
 *
 * @property integer $emp_id
 * @property string $title
 * @property string $name
 * @property string $surname
 * @property string $address
 * @property string $zip_code
 * @property string $birthday
 * @property string $email
 * @property string $mobile_phone
 * @property string $modify_date
 * @property string $create_date
 * @property integer $position
 * @property integer $salary
 * @property string $expire_date
 * @property string $website
 * @property string $skill
 */
class Employee extends \yii\db\ActiveRecord
{
    const UPLOAD_PATH  = 'uploads';
    const RESUME_PATH  = 'resumes';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title','name','surname','sex'], 'required'],
            [['emp_id', 'salary','province','amphur','district','marital','sex','age','count_download_resume'], 'integer'],
            [['address'], 'string'],
            [['birthday', 'modify_date', 'create_date', 'expire_date','social','skill'], 'safe'],
            [['title'], 'string', 'max' => 50],
            [['name', 'surname', 'email','token_forupload'], 'string', 'max' => 100],
            [['zip_code','countries','experience'], 'string', 'max' => 10],
            [['mobile_phone','personal_id'], 'string', 'max' => 20],
            [['website','position'], 'string', 'max' => 150],
            //[['skill'], 'string', 'max' => 255],
            [['resume'],'file'],
            [['email'],'email'],
            [['website'],'url']
        ];
    }



    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_date',
                'updatedAtAttribute' => 'modify_date',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'emp_id' => 'Emp ID',
            'title' => 'คำนำหน้า',
            'name' => 'ชื่อ',
            'surname' => 'นามสกุล',
            'address' => 'บ้านเลขที่, ถนน, หมู่บ้าน',
            'zip_code' => 'รหัสไปรษณีย์',
            'birthday' => 'วันเกิด',
            'email' => 'อีเมล์',
            'mobile_phone' => 'เบอร์มือถือ',
            'modify_date' => 'แก้ไขวันที่',
            'create_date' => 'สร้างวันที่',
            'position' => 'ตำแหน่งงาน',
            'salary' => 'เงินเดือน',
            'expire_date' => 'วันที่ลาออก',
            'website' => 'เว็บไซต์',
            'skill' => 'ทักษะ',
            'age'=>'อายุ',
            'sex'=>'เพศ',
            'countries'=> 'ประเทศ',
            'website'=>'เว็บไซต์',
            'experience'=>'ประสบการณ์การทำงาน',
            'personal_id'=>'เลขที่บัตรประชาชน',
            'marital'=> 'สถานะสมรศ',
            'province'=>'จังหวัด',
            'amphur'=>'อำเภอ',
            'district'=> 'ตำบล',
            'resume'=>'ไฟล์ประวัติส่วนตัว (pdf)',
            // virtual attribute
            'fullName'=>'ชื่อ-นามสกุล',
            'provinceName'=>'จังหวัด',
            'amphurName'=>'อำเภอ',
            'districtName'=>'ตำบล'
        ];
    }



    public function getArray($value)
    {
        return explode(',', $value);
    }

    public function setToArray($value)
    {   
        return is_array($value)?implode(',', $value):NULL;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if(!empty($this->social)){
                $this->social = $this->setToArray($this->social);
                $this->skill = $this->setToArray($this->skill);
            }
            return true;
        } else {
            return false;
        }
    }

    public static function itemAlias($type,$code=NULL) {
        $_items = array(
            'sex' => array(
                '1' => 'ชาย',
                '2' => 'หญิง',
            ),
            'marital' => array(
                '1' => 'โสด',
                '2' => 'สมรส',
                '3' => 'อย่างร้าง',
                '4' => 'แยกกันอยู่',
                '5' => 'หมา้ย',
            ),
            'skill'=>[
                'Objective C'=>'Objective C',
                'Python'=>'Python',
                'Java'=>'Java',
                'JavaScript'=>'JavaScript',
                'PHP'=>'PHP',
                'SQL'=>'SQL',
                'Ruby'=>'Ruby',
                'FoxPro'=>'FoxPro',
                'C++'=>'C++',
                'C'=>'C',
                'ASP'=>'ASP',
                'Assembly'=>'Assembly',
                'Visual Basic'=>'Visual Basic'
            ],
            'social' => [
                'facebook' => 'Facebook',
                'twiter' => 'Twiter',
                'google+' => 'Google+',
                'tumblr' => 'Tumblr'
            ],
        );
        

        if (isset($code)){
            return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
        }
        else{         
            return isset($_items[$type]) ? $_items[$type] : false;    
        }
    }

    public static function getUploadPath(){
        return Yii::getAlias('@webroot').'/'.self::UPLOAD_PATH;
    }

    public static function getUploadUrl(){
        return Url::base(true).'/'.self::UPLOAD_PATH;
    }

    public static function getResumePath(){
        return Yii::getAlias('@webroot').'/'.self::RESUME_PATH;
    }

    public static function getResumeUrl(){
        return Url::base(true).'/'.self::RESUME_PATH;
    }


    // Inverse Relations  & Virtual attribute

    public function getFullname(){
        return $this->title.$this->name.' '.$this->surname;
    }

    public function getProvinces(){
        return @$this->hasOne(Province::className(),['PROVINCE_ID'=>'province']);
    }
    public function getProvinceName(){
        return @$this->provinces->PROVINCE_NAME;
    }

    public function getAmphurs(){
        return @$this->hasOne(Amphur::className(),['AMPHUR_ID'=>'province']);
    }
    public function getAmphurName(){
        return @$this->amphurs->AMPHUR_NAME;
    }

    public function getDistricts(){
        return @$this->hasOne(District::className(),['DISTRICT_ID'=>'province']);
    }
    public function getDistrictName(){
        return @$this->districts->DISTRICT_NAME;
    }



}
