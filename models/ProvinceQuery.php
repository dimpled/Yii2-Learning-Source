<?php

namespace app\models;

use Yii;

/**
 * This is the ActiveQuery class for [[Province]].
 *
 * @see Province
 */
class ProvinceQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Province[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Province|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function loadGroupProvince(){
      return Yii::$app->db->createCommand('
          SELECT
          	count(*) as total_amphur,
          	province.PROVINCE_NAME
          FROM
          	province
          LEFT JOIN amphur ON amphur.PROVINCE_ID = province.PROVINCE_ID
          group by province.PROVINCE_ID
          ORDER BY count(*) desc limit 10
      ')->queryAll();
    }

    public function loadPieChartData(){
      $pieData=[];
      $provinces = $this->loadGroupProvince();
      foreach ($provinces as $key => $value) {
        $pieData[] = ['name'=>$value['PROVINCE_NAME'],'y'=>(int)$value['total_amphur']];
      }
      return [
        'provinces' => $provinces,
        'pieData'=>$pieData
      ];
    }


    public function getDataFromSql(){
      $sql = "SELECT
        	count(*)AS total_amphur,
        	province.PROVINCE_NAME
        FROM
        	province
        LEFT JOIN amphur ON amphur.PROVINCE_ID = province.PROVINCE_ID
        GROUP BY
        	province.PROVINCE_ID
        ORDER BY
        	count(*) DESC
        LIMIT 10";
      return Yii::$app->db->createCommand($sql)->queryAll();
      //return Yii::$app->db->createCommand($sql)->queryOne();
      //return Yii::$app->db->createCommand($sql)->execute();
    }

}
