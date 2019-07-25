<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "opening_hours".
 *
 * @property int $id id
 * @property int $exchange_point_id Точка обмена
 * @property int $day День недели
 * @property int $break_time_start Начало
 * @property int $time_start Начало
 * @property int $time_end Окончание
 * @property int $break_time_end Окончание
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
        foreach (range(0, 1440, 5) as $time) {
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

    public function getFrom()
    {
        return self::map()[$this->time_start] ?: "no";
    }

    public function getTo()
    {
        return self::map()[$this->time_end] ?: 'no';
    }

    public function getBreakTo()
    {
        return self::map()[$this->break_time_end] ?: 'no';
    }

    public function getBreakFrom()
    {
        return self::map()[$this->break_time_start] ?: 'no';
    }

    public function fields()
    {
        $fields = parent::fields();
        unset($fields['exchange_point_id']);
        unset($fields['day']);
        $fields[] = 'from';
        $fields[] = 'to';
        $fields[] = 'breakFrom';
        $fields[] = 'breakTo';


        return $fields;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['exchange_point_id', 'day', 'time_start', 'time_end', 'break_time_end', 'break_time_start'], 'integer'],
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
            'break_time_start' => Yii::t('app', 'Обед с'),
            'time_end' => Yii::t('app', 'Окончание'),
            'break_time_end' => Yii::t('app', 'До'),
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
