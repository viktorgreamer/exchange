<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ExchangeRates;

/**
 * ExchangeRatesSearch represents the model behind the search form of `common\models\ExchangeRates`.
 */
class ExchangeRatesSearch extends ExchangeRates
{
    public $city_id;
    public $region_id;

    public $type = 'buy';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'point_id', 'pair_id', 'region_id', 'city_id', 'status', 'updated_at'], 'integer'],
            [['buy', 'sell'], 'number'],
            [['type'], 'string'],
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
        $query = ExchangeRates::find();
        $query->from(['r' => ExchangeRates::tableName()]);
        $query->joinWith('point as p');
        $query->joinWith('pair as pair');


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, '');

        if (!$this->validate()) {
            return $dataProvider;
        }

        if ($this->city_id) {
            $query->andWhere(['p.city_id' => $this->city_id]);
        }

        if ($this->region_id) {
            $query->andWhere(['p.region_id' => $this->region_id]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'point_id' => $this->point_id,
            'pair_id' => $this->pair_id,
            'status' => $this->status,
        ]);

        if ($this->type == 'buy') $query->orderBy(['r.buy' => SORT_ASC]);
        if ($this->type == 'sell') $query->orderBy(['r.sell' => SORT_DESC]);


        return $dataProvider;
    }
}
