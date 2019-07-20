<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "request".
 *
 * @property int $id id
 * @property int $created_at Создан
 * @property int $reason Причина
 * @property int $user_id Пользователь
 * @property string $body Вопрос
 * @property string $email Email
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'reason', 'user_id'], 'integer'],
            [['body'], 'required'],
            [['body'], 'string'],
            [['email'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'id'),
            'created_at' => Yii::t('app', 'Создан'),
            'reason' => Yii::t('app', 'Причина'),
            'user_id' => Yii::t('app', 'Пользователь'),
            'body' => Yii::t('app', 'Вопрос'),
            'email' => Yii::t('app', 'Email'),
        ];
    }
}
