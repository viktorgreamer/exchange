<?php

namespace app\modules\entities\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ExchangePoints;

/**
 * ExchangePointsSearch represents the model behind the search form of `common\models\ExchangePoints`.
 */
class ExchangePointsSearch extends ExchangePoints
{

    public $query;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'entity_id', 'city_id', 'region_id', 'status'], 'integer'],
            [['address', 'phone1', 'phone2', 'name', 'link'], 'safe'],
            [['query'], 'string'],
            [['latitude', 'longitude', 'rating', 'rating_geo', 'rating_actuality', 'rating_service'], 'number'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'query' => "Запрос",
             'city_id' => 'Город'
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
        $query = ExchangePoints::find();
        $query->from(['p' => ExchangePoints::tableName()]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails

            return $dataProvider;
        }

       if (\Yii::$app->user->identity->entity) $query->andWhere(['entity_id' => \Yii::$app->user->identity->entity->id]);
       else $query->where('0=1');

        if ($this->query) {
            $query->joinWith('region as region');
            $query->joinWith('city as city');

            $query->andWhere(['OR',
                ['like', 'p.name',$this->query],
                ['like', 'address',$this->query],
                ['like', 'region.name',$this->query],
                ['like', 'city.name',$this->query],
            ]);

        }

        if ($this->city) {
            $query->andWhere(['p.city_id' => $this->city_id]);
        }

        return $dataProvider;
    }
}
