<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "pairs".
 *
 * @property int $id id
 * @property string $name Наименование
 * @property string $currency_from_id С валюта
 * @property string $currency_to_id На валюту
 * @property string $render На валюту
 * @property Currencies $currencyFrom
 * @property Currencies $currencyTo
 * @property ExchangeRates[] $exchangeRates
 */
class Pairs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pairs';
    }

    public static function map()
    {
        return ArrayHelper::map(self::find()->all(), 'id', 'render');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
            [['currency_from_id', 'currency_to_id'], 'integer', 'max' => 255],
            [['currency_from_id', 'currency_to_id'], 'variousCurrencies'],
            [['currency_from_id', 'currency_to_id'], 'existedPair'],
        ];
    }

    public function variousCurrencies()
    {
        if ($this->currency_from_id == $this->currency_to_id) $this->addError('currency_to_id', Yii::t('app', 'Выберите разные валюты.'));
    }

    public function existedPair()
    {
        if (self::find()->where(
                [
                    'currency_to_id' => $this->currency_to_id,
                    'currency_from_id' => $this->currency_from_id
                ])->andWhere(['<>', 'id', $this->id])->exists() || self::find()->where(
                [
                    'currency_to_id' => $this->currency_from_id,
                    'currency_from_id' => $this->currency_to_id
                ])->andWhere(['<>', 'id', $this->id])->exists()) $this->addError('currency_to_id', Yii::t('app', 'Данная валютная пара уже существует.'));
    }

    public function getRender()
    {
        return $this->currencyFrom->mark . "/" . $this->currencyTo->mark;
    }

    public function getCurrencyFrom()
    {
        return $this->hasOne(Currencies::className(), ['id' => 'currency_from_id']);
    }

    public function getCurrencyTo()
    {
        return $this->hasOne(Currencies::className(), ['id' => 'currency_to_id']);
    }

    public function fields()
    {
        $fields = parent::fields();
        $fields[] = 'render';
        return $fields;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'id'),
            'name' => Yii::t('app', 'Наименование'),
            'currency_from_id' => Yii::t('app', 'С валюты'),
            'currency_to_id' => Yii::t('app', 'На валюту'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExchangeRates()
    {
        return $this->hasMany(ExchangeRates::className(), ['pair_id' => 'id']);
    }
}
