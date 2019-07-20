<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "opening_hours".
 *
 * @property int $id id
 * @property int $exchange_point_id Точка обмена
 * @property int $day День недели
 * @property int $time_start Начало
 * @property int $time_end Окончание
 *
 * @property ExchangePoints $exchangePoint
 */
class OpeningHours extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'opening_hours';
    }

    public static function map()
    {
        $times = [];
        foreach (range(0, 24 * 60, 5) as $time) {
            $times[$time] = str_pad(floor($time / 60), 2, "0", STR_PAD_LEFT) . ":" . str_pad(($time - floor($time / 60) * 60), 2, "0", STR_PAD_LEFT);
        }
        return $times;
    }

    public static function mapDays()
    {
        return [
          1 => 'ПН',
          2 => 'ВТ',
          3 => 'СР',
          4 => 'ЧТ',
          5 => 'ПТ',
          6 => 'СБ',
          7 => 'ВС',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['exchange_point_id', 'day', 'time_start', 'time_end'], 'integer'],
            [['exchange_point_id'], 'exist', 'skipOnError' => true, 'targetClass' => ExchangePoints::className(), 'targetAttribute' => ['exchange_point_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'id'),
            'exchange_point_id' => Yii::t('app', 'Точка обмена'),
            'day' => Yii::t('app', 'День недели'),
            'time_start' => Yii::t('app', 'Начало'),
            'time_end' => Yii::t('app', 'Окончание'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExchangePoint()
    {
        return $this->hasOne(ExchangePoints::className(), ['id' => 'exchange_point_id']);
    }
}
