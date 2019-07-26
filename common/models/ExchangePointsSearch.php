<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ExchangePoints;

/**
 * ExchangePointsSearch represents the model behind the search form of `common\models\ExchangePoints`.
 */
class ExchangePointsSearch extends Model
{

    public $id;
    public $query;
    public $address;
    public $latitude;
    public $longitude;
    public $entity_id;
    public $city_id;
    public $region_id;
    public $time_start;
    public $time_end;
    public $phone1;
    public $phone2;
    public $name;
    public $link;
    public $status;
    public $main;
    public $rating;
    public $rating_geo;
    public $rating_actuality;
    public $rating_service;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'entity_id', 'city_id', 'region_id', 'status'], 'integer'],
            [['phone1', 'phone2', 'name', 'link'], 'safe'],
            [['query'], 'string'],
            [['latitude', 'longitude', 'rating', 'rating_geo', 'rating_actuality', 'rating_service'], 'number'],
        ];
    }

    public function formName()
    {
        return '';
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
        $query = ExchangePoints::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, '');

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'entity_id' => $this->entity_id,
            'city_id' => $this->city_id,
            'region_id' => $this->region_id,
            'status' => $this->status,
            'rating' => $this->rating,
            'rating_geo' => $this->rating_geo,
            'rating_actuality' => $this->rating_actuality,
            'rating_service' => $this->rating_service,
        ]);


        if ($this->address) {
            $query->joinWith('region as region');
            $query->joinWith('city as city');

            $query->andWhere(['OR',
                ['like', 'address',$this->address],
                ['like', 'region.name',$this->address],
                ['like', 'city.name',$this->address],
            ]);

        }
        $query->andFilterWhere(['like', 'phone1', $this->phone1])
            ->andFilterWhere(['like', 'phone2', $this->phone2])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'link', $this->link]);

        return $dataProvider;
    }
}
