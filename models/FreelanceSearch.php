<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Freelance;

/**
 * FreelanceSearch represents the model behind the search form about `app\models\Freelance`.
 */
class FreelanceSearch extends Freelance
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['ref', 'title', 'description', 'covenant', 'docs', 'start_date', 'end_date', 'success_date', 'create_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Freelance::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'success_date' => $this->success_date,
            'create_date' => $this->create_date,
        ]);

        $query->andFilterWhere(['like', 'ref', $this->ref])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'covenant', $this->covenant])
            ->andFilterWhere(['like', 'docs', $this->docs]);

        return $dataProvider;
    }
}
