<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "exchange_rates".
 *
 * @property int $id id
 * @property int $point_id Сеть
 * @property int $pair_id Валюты
 * @property int $status Статус
 * @property double $buy Цена покупки
 * @property double $sell Цена прожи
 * @property int $created_at Создан в
 * @property int $updated_at Обновлен в
 * @property ExchangePoints $point
 * @property Pairs $pair
 */
class ExchangeRates extends \yii\db\ActiveRecord
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

    public function fields()
    {
        $fields = parent::fields();
        $fields[] = 'pair';
        $fields[] = 'point';
        unset($fields['created_at']);
        return $fields;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'exchange_rates';
    }

    public function beforeValidate()
    {
        $this->buy = $this->filterNumeric($this->buy);
        $this->sell = $this->filterNumeric($this->sell);
        return parent::beforeValidate();
    }

    public function filterNumeric($value)
    {
        return preg_replace("/,/", '.', $value);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['point_id', 'pair_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['buy', 'sell'], 'number'],
            [['point_id', 'pair_id','buy','sell'], 'required'],
            [['point_id'], 'exist', 'skipOnError' => true, 'targetClass' => ExchangePoints::className(), 'targetAttribute' => ['point_id' => 'id']],
            [['pair_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pairs::className(), 'targetAttribute' => ['pair_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'id'),
            'point_id' => Yii::t('app', 'Сеть'),
            'pair_id' => Yii::t('app', 'Валюты'),
            'status' => Yii::t('app', 'Статус'),
            'buy' => Yii::t('app', 'Цена покупки'),
            'sell' => Yii::t('app', 'Цена продажи'),
            'created_at' => Yii::t('app', 'Создан в'),
            'updated_at' => Yii::t('app', 'Обновлен в'),
        ];
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPoint()
    {
        return $this->hasOne(ExchangePoints::className(), ['id' => 'point_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPair()
    {
        return $this->hasOne(Pairs::className(), ['id' => 'pair_id']);
    }
}
