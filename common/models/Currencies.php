<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "currencies".
 *
 * @property int $id id
 * @property string $name Наименование
 * @property string $mark Наименование
 */
class Currencies extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'currencies';
    }

    public static function map()
    {
        return ArrayHelper::map(self::find()->all(), 'id', 'mark');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'mark'], 'string', 'max' => 255],
            [['mark'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'id'),
            'name' => Yii::t('app', 'Наименование'),
            'mark' => Yii::t('app', 'Обозначение'),
        ];
    }
}
