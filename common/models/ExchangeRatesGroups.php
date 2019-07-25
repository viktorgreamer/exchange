<?php

namespace common\models;

use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "exchange_rates_groups".
 *
 * @property int $id id
 * @property string $name Название
 * @property int $entity_id Компания
 *
 * @property Entities $entity
 * @property GroupExchangeRates[] $groupExchangeRates
 * @property string $rates
 */
class ExchangeRatesGroups extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'exchange_rates_groups';
    }

    public function behaviors()
    {
        return [
            'saveRelations' => [
                'class' => SaveRelationsBehavior::className(),
                'relations' => [
                      'exchangeRates',
                ],
            ],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'entity_id'], 'required'],
            [['entity_id'], 'integer'],
            [['name'], 'string'],
            [['exchangeRates'], 'safe'],
            [['entity_id'], 'exist', 'skipOnError' => true, 'targetClass' => Entities::className(), 'targetAttribute' => ['entity_id' => 'id']],
        ];
    }

    public function beforeValidate()
    {

        if (!$this->entity_id) {
            if ($entity = Entities::findOne(['user_id' => Yii::$app->user->id])) {
                $this->entity_id = $entity->id;
            }
        }

        return parent::beforeValidate();
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'entity_id' => 'Компания',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntity()
    {
        return $this->hasOne(Entities::className(), ['id' => 'entity_id']);
    }

    public function getExchangeRates()
    {
        return $this->hasMany(GroupExchangeRates::className(), ['group_id' => 'id']);
    }


    /**
     * update currencies if point has groups exists
     */

    public function afterSetCurrencies()
    {
        try {
            if ($entityPointsId = ExchangePoints::find()->where(['group_id' => $this->id])
                ->andWhere(['entity_id' => Yii::$app->user->identity->entity->id])->select('id')->column()) {
                if ($rates = GroupExchangeRates::find()->where(['group_id' => $this->id])->all()) {
                    /** @var ExchangeRates[] $rates */
                    foreach ($rates as $rate) {
                        ExchangeRates::updateAll(['buy' => $rate->buy, 'sell' => $rate->sell],
                            [
                                'AND',
                                ['pair_id' => $rate->pair_id],
                                ['group_id' => $this->id]
                            ]);
                    }
                }
            }
        } catch (\Exception $exception) {
            Yii::$app->session->setFlash('error','Что-то пошло нетак.');
        }

    }

    public function setCurrencies($rates)
    {
        $allValidated = false;
        if ($rates) {
            $allValidated = true;
            foreach ($rates as $rate) {
                if ($exchangeRate = GroupExchangeRates::findOne(['group_id' => $this->id, 'pair_id' => $rate['pair_id']])) {
                    $exchangeRate->buy = $rate['buy'];
                    $exchangeRate->sell = $rate['sell'];
                } else {
                    $exchangeRate = new GroupExchangeRates(
                        [
                            'group_id' => $this->id,
                            'pair_id' => $rate['pair_id'],
                            'buy' => $rate['buy'],
                            'sell' => $rate['sell'],
                        ]);

                }
                $allValidated = $exchangeRate->save() && $allValidated;
                if (!$allValidated) $this->addError('currencies', 'Ошибка установки курсов. ');
            }
            if ($allValidated) $this->afterSetCurrencies();
        }

        return $allValidated;
    }

    public
    function getCurrencies()
    {
        return $this->getExchangeRates()->asArray()->all();
    }




    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupExchangeRates()
    {
        return $this->hasMany(GroupExchangeRates::className(), ['group_id' => 'id']);
    }

    public function getRates()
    {
        if ($this->exchangeRates) {
            $trs = [];
            foreach ($this->exchangeRates as $exchangeRate) {
                $trs[] = Html::tag('tr', Html::tag('td', $exchangeRate->pair->render . Html::tag('td', $exchangeRate->buy) . Html::tag('td', $exchangeRate->sell)));
            }
            return Html::tag('table', implode("", $trs), ['class' => 'table table-stripped']);
        }
    }

}
