<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "location".
 *
 * @property integer $id
 * @property string $country
 * @property string $city
 * @property double $latitude
 * @property double $longitude
 * @property double $altitude
 */
class Location extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'location';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country', 'city', 'latitude', 'longitude', 'altitude'], 'required'],
            [['latitude', 'longitude', 'altitude'], 'number'],
            [['country'], 'string', 'max' => 25],
            [['city'], 'string', 'max' => 40]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country' => 'Country',
            'city' => 'City',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'altitude' => 'Altitude',
        ];
    }
}
