<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "located_region".
 *
 * @property int $id
 * @property int $country_id
 * @property string $region
 *
 * @property LocatedArea[] $locatedAreas
 * @property LocatedCountries $country
 * @property LocatedVillage[] $locatedVillages
 */
class LocatedRegion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'located_region';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['country_id'], 'integer'],
            [['region'], 'required'],
            [['region'], 'string', 'max' => 60],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => LocatedCountries::className(), 'targetAttribute' => ['country_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country_id' => 'Country ID',
            'region' => 'Region',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocatedAreas()
    {
        return $this->hasMany(LocatedArea::className(), ['region_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(LocatedCountries::className(), ['id' => 'country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocatedVillages()
    {
        return $this->hasMany(LocatedVillage::className(), ['region_id' => 'id']);
    }
}
