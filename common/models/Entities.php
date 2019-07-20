<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "entities".
 *
 * @property int $id id
 * @property int $user_id id Пользователя
 * @property string $name Наименование
 * @property int $has_one_currency Единый курс
 * @property int $has_one_opening_hours Единый график работы
 * @property string $phone Телефон
 * @property int $status Статус
 *
 * @property ExchangePoints[] $exchangePoints
 * @property ExchangeRates[] $exchangeRates
 */
class Entities extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'entities';
    }

    public static function map()
    {
        return ArrayHelper::map(self::find()->all(), 'id', 'name');
    }

    public function behaviors()
    {
        return [
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'user_id',
                'updatedByAttribute' => false
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['user_id', 'has_one_currency', 'has_one_opening_hours', 'status'], 'integer'],
            [['name'], 'string', 'max' => 256],
            [['phone'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'id'),
            'user_id' => Yii::t('app', 'id Пользователя'),
            'name' => Yii::t('app', 'Наименование'),
            'has_one_currency' => Yii::t('app', 'Единый курс'),
            'has_one_opening_hours' => Yii::t('app', 'Единый график работы'),
            'phone' => Yii::t('app', 'Телефон'),
            'status' => Yii::t('app', 'Статус'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExchangePoints()
    {
        return $this->hasMany(ExchangePoints::className(), ['entity_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExchangeRates()
    {
        return $this->hasMany(ExchangeRates::className(), ['entity_id' => 'id']);
    }
}
