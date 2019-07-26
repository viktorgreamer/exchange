<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "located_area".
 *
 * @property int $id
 * @property int $country_id
 * @property int $region_id
 * @property string $area
 *
 * @property LocatedRegion $region
 * @property LocatedCountries $country
 * @property LocatedVillage[] $locatedVillages
 */
class LocatedArea extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'located_area';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['country_id', 'region_id', 'area'], 'required'],
            [['country_id', 'region_id'], 'integer'],
            [['area'], 'string', 'max' => 150],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => LocatedRegion::className(), 'targetAttribute' => ['region_id' => 'id']],
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
            'region_id' => 'Region ID',
            'area' => 'Area',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(LocatedRegion::className(), ['id' => 'region_id']);
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
        return $this->hasMany(LocatedVillage::className(), ['area_id' => 'id']);
    }
}
