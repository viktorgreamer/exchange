<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "reviews".
 *
 * @property int $id id
 * @property int $user_id Пользователь
 * @property int $created_at Создан
 * @property int $status Статус
 * @property int $rating_geo Рейтинг расположения
 * @property int $rating_actuality Рейтинг актуальности курса
 * @property int $rating_service Рейтинг обслуживания
 *
 * @property User $user
 */
class Reviews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reviews';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'created_at', 'status', 'rating_geo', 'rating_actuality', 'rating_service'], 'integer'],
            [['created_at'], 'required'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'id'),
            'user_id' => Yii::t('app', 'Пользователь'),
            'created_at' => Yii::t('app', 'Создан'),
            'status' => Yii::t('app', 'Статус'),
            'rating_geo' => Yii::t('app', 'Рейтинг расположения'),
            'rating_actuality' => Yii::t('app', 'Рейтинг актуальности курса'),
            'rating_service' => Yii::t('app', 'Рейтинг обслуживания'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
