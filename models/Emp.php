<?php

namespace app\models;

use Yii;
use app\models\Province;
/**
 * This is the model class for table "employee".
 *
 * @property integer $emp_id
 * @property integer $sex
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
 * @property string $position
 * @property integer $salary
 * @property string $expire_date
 * @property string $website
 * @property string $skill
 * @property string $countries
 * @property integer $age
 * @property string $experience
 * @property string $personal_id
 * @property integer $marital
 * @property string $province
 * @property string $amphur
 * @property string $district
 * @property string $social
 * @property string $resume
 * @property string $token_forupload
 * @property integer $count_download_resume
 */
class Emp extends \yii\db\ActiveRecord
{
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
            // ['fieldName','ValidateName','Options'],
            // [['f1','f2'],'ValidateName','Options'],
            [['title','name','surname'],'required'],
            ['social','safe'],

            [['sex', 'salary', 'age', 'marital', 'count_download_resume'], 'integer'],
            [['address'], 'string'],
            [['birthday', 'modify_date', 'create_date', 'expire_date'], 'safe'],
            [['title'], 'string', 'max' => 50],
            [['name', 'surname', 'email', 'resume', 'token_forupload'], 'string', 'max' => 100],
            [['zip_code', 'countries', 'experience'], 'string', 'max' => 10],
            [['mobile_phone', 'personal_id'], 'string', 'max' => 20],
            [['position', 'website'], 'string', 'max' => 150],
            [['skill'], 'string', 'max' => 255],
            [['province', 'amphur', 'district'], 'string', 'max' => 6]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'emp_id' => 'Emp ID',
            'sex' => 'เพศ',
            'title' => 'คำนำหน้า',
            'name' => 'ชื่อ',
            'surname' => 'นามสกุล',
            'address' => 'ที่อยู่',
            'zip_code' => 'รหัสไปรษณีย์',
            'birthday' => 'วันเกิด',
            'email' => 'อีเมล์',
            'mobile_phone' => 'เบอร์มือถือ',
            'modify_date' => 'แก้ไขวันที่',
            'create_date' => 'สร้างวันที่',
            'position' => 'ตำแหน่งงาน',
            'salary' => 'เงินเดือน',
            'expire_date' => 'วันที่ลาออก',
            'website' => 'Website',
            'skill' => 'Skill',
            'countries' => 'ประเทศ',
            'age' => 'อายุ',
            'experience' => 'ประสบการณ์การทำงาน',
            'personal_id' => 'เลขที่บัตรประชาชน',
            'marital' => 'สถานนะภาพการสมรส',
            'province' => 'จังหวัด',
            'amphur' => 'อำเภอ',
            'district' => 'ตำบล',
            'social' => 'ใช้ social network อะไรบ้าง',
            'resume' => 'ไฟล์ resume',
            'token_forupload' => 'Token Forupload',
            'count_download_resume' => 'นับจำนวนที่ download resume',
        ];
    }

    /**
     * @inheritdoc
     * @return EmpQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EmpQuery(get_called_class());
    }

    public function getProv()
    {
      return @$this->hasOne(Province::className(),
      ['PROVINCE_ID' => 'province']);
    }

    public function getProvinceName(){
      return @$this->prov->PROVINCE_NAME;
    }
}
