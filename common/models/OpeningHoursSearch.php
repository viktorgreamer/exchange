<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\OpeningHours;

/**
 * OpeningHoursSearch represents the model behind the search form of `common\models\OpeningHours`.
 */
class OpeningHoursSearch extends OpeningHours
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'exchange_point_id', 'day', 'time_start', 'time_end'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = OpeningHours::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'exchange_point_id' => $this->exchange_point_id,
            'day' => $this->day,
            'time_start' => $this->time_start,
            'time_end' => $this->time_end,
        ]);

        return $dataProvider;
    }
}
