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
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'entity_id', 'city_id', 'region_id', 'status'], 'integer'],
            [['address', 'phone1', 'phone2', 'name', 'link'], 'safe'],
            [['latitude', 'longitude', 'rating', 'rating_geo', 'rating_actuality', 'rating_service'], 'number'],
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
        return $dataProvider;
    }
}
