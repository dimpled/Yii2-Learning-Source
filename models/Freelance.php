<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "freelance".
 *
 * @property integer $id
 * @property string $ref
 * @property string $title
 * @property string $description
 * @property string $covenant
 * @property string $docs
 * @property string $start_date
 * @property string $end_date
 * @property string $succes_date
 * @property string $create_date
 */
class Freelance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'freelance';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'],'required'],
            [['description'], 'string'],
            [['start_date', 'end_date', 'succes_date', 'create_date','docs'], 'safe'],
            [['ref'], 'string', 'max' => 20],
            [['title'], 'string', 'max' => 255],
            [['covenant'],'file','maxFiles'=>1],
            [['docs'],'file','maxFiles'=>10,'skipOnEmpty'=>true]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ref' => 'หลายเลข referent สำหรับอัพโหลดไฟล์ ajax',
            'title' => 'ชื่องาน',
            'description' => 'รายละเอียด',
            'covenant' => 'หนังสือสัญญา',
            'docs' => 'เอกสารประกอบ',
            'start_date' => 'วันที่เริ่มสัญญา',
            'end_date' => 'วันที่สิ้นสุดสัญญา',
            'succes_date' => 'งานเสร็จวันที่',
            'create_date' => 'สร้างวันที่',
        ];
    }
}
