<?php

use yii\db\Migration;

/**
 * Class m190718_194918_add_entities
 */
class m190718_170000_add_entities extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('{{%entities}}',[
            'id' => $this->primaryKey()->comment('id'),
            'user_id' => $this->integer()->notNull()->comment('id Пользователя'),
            'name' => $this->string(256)->notNull()->comment('Наименование'),
            'has_one_currency' => $this->boolean()->notNull()->defaultValue(false)->comment('Единый курс'),
            'has_one_opening_hours' => $this->boolean()->notNull()->defaultValue(false)->comment('Единый график работы'),
            'phone' => $this->string(30)->null()->comment('Телефон'),
            'status' => $this->integer(1)->null()->comment('Статус')
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%entities}}');
    }

}
