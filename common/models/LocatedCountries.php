<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "located_countries".
 *
 * @property int $id
 * @property string $country
 *
 * @property LocatedArea[] $locatedAreas
 * @property LocatedRegion[] $locatedRegions
 * @property LocatedVillage[] $locatedVillages
 */
class LocatedCountries extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'located_countries';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['country'], 'required'],
            [['country'], 'string', 'max' => 60],
            [['country'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country' => 'Country',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocatedAreas()
    {
        return $this->hasMany(LocatedArea::className(), ['country_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocatedRegions()
    {
        return $this->hasMany(LocatedRegion::className(), ['country_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocatedVillages()
    {
        return $this->hasMany(LocatedVillage::className(), ['country_id' => 'id']);
    }
}
