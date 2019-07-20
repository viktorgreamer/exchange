<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Reviews;

/**
 * ArticlesSearch represents the model behind the search form of `common\models\Reviews`.
 */
class ReviewsSearch extends Reviews
{

    public $query;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'program_id', 'user_id', 'using_time', 'status'], 'integer'],
            ['query', 'string']
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
        $query = Reviews::find();
        $query->from(['r' => Reviews::tableName()]);
        // $query->joinWith('user as user');

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
        $query->andFilterWhere(['r.status' => $this->status]);
        if ($this->program_id) $query->andWhere(['r.program_id' => $this->program_id]);
        if ($this->query) $query->andWhere([
            'OR',
            ['like', 'r.common' => $this->query],
            ['like', 'r.title' => $this->query],
            ['like', 'r.minuses' => $this->query],
            ['like', 'r.pluses' => $this->query]
        ]);

        return $dataProvider;
    }
}
