<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "located_village".
 *
 * @property int $id
 * @property int $country_id
 * @property int $region_id
 * @property int $area_id
 * @property string $village
 *
 * @property LocatedArea $area
 * @property LocatedCountries $country
 * @property LocatedRegion $region
 */
class LocatedVillage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'located_village';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['country_id', 'region_id', 'area_id'], 'integer'],
            [['village'], 'required'],
            [['village'], 'string', 'max' => 150],
            [['area_id', 'village'], 'unique', 'targetAttribute' => ['area_id', 'village']],
            [['area_id'], 'exist', 'skipOnError' => true, 'targetClass' => LocatedArea::className(), 'targetAttribute' => ['area_id' => 'id']],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => LocatedCountries::className(), 'targetAttribute' => ['country_id' => 'id']],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => LocatedRegion::className(), 'targetAttribute' => ['region_id' => 'id']],
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
            'area_id' => 'Area ID',
            'village' => 'Village',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArea()
    {
        return $this->hasOne(LocatedArea::className(), ['id' => 'area_id']);
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
    public function getRegion()
    {
        return $this->hasOne(LocatedRegion::className(), ['id' => 'region_id']);
    }
}
