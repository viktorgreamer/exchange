<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "group_exchange_rates".
 *
 * @property int $id id
 * @property int $group_id Пункт обмена
 * @property int $pair_id Валюты
 * @property int $status Статус
 * @property double $buy Цена покупки
 * @property double $sell Цена продажи
 * @property int $created_at Создан в
 * @property int $updated_at Обновлен в
 * @property Pairs $pair
 * @property ExchangeRatesGroups $group
 * @property string $rates
 */
class GroupExchangeRates extends \yii\db\ActiveRecord
{

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'group_exchange_rates';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['group_id', 'pair_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['buy', 'sell'], 'number'],
            [['pair_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pairs::className(), 'targetAttribute' => ['pair_id' => 'id']],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => ExchangeRatesGroups::className(), 'targetAttribute' => ['group_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group_id' => 'Group ID',
            'pair_id' => 'Pair ID',
            'status' => 'Status',
            'buy' => 'Buy',
            'sell' => 'Sell',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPair()
    {
        return $this->hasOne(Pairs::className(), ['id' => 'pair_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(ExchangeRatesGroups::className(), ['id' => 'group_id']);
    }
}
