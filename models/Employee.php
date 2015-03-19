<?php

namespace app\models;

use Yii;
use yii\helpers\Url;

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
            [['title'], 'required'],
            [['emp_id', 'salary','province','amphur','district','marital','sex','age'], 'integer'],
            [['address'], 'string'],
            [['birthday', 'modify_date', 'create_date', 'expire_date','social'], 'safe'],
            [['title'], 'string', 'max' => 50],
            [['name', 'surname', 'email','token_forupload'], 'string', 'max' => 100],
            [['zip_code','countries','experience'], 'string', 'max' => 10],
            [['mobile_phone','personal_id'], 'string', 'max' => 20],
            [['website','position'], 'string', 'max' => 150],
            [['skill'], 'string', 'max' => 255],
            [['resume'],'file'],
            [['email'],'email'],
            [['website'],'url']
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
            'district'=> 'ตำบล'
        ];
    }

    public function getSocialArray()
    {
        return explode(',', $this->social);
    }

    public function setSocialArray(array $value)
    {
        $this->social = implode(',', $value);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if(!empty($this->social)){
                $this->setSocialArray($this->social);
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
            'social' => array(
                'facebook' => 'Facebook',
                'twiter' => 'Twiter',
                'google+' => 'Google+',
                'tumblr' => 'Tumblr'
            ),
        );
        if (isset($code))
            return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
        else
            return isset($_items[$type]) ? $_items[$type] : false;
    }

    public static function getUploadPath(){
        return Yii::getAlias('@web').'/'.self::UPLOAD_PATH;
    }

    public static function getUploadUrl(){
        return Url::base(true).'/'.self::UPLOAD_PATH;
    }

}
