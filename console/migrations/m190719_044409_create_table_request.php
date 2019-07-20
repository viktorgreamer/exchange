<?php

use yii\db\Migration;

/**
 * Class m190719_044409_create_table_request
 */
class m190719_044409_create_table_request extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%request}}',[
            'id' => $this->primaryKey()->comment('id'),
            'created_at' => $this->integer()->comment('Создан'),
            'reason' => $this->integer()->comment('Причина'),
            'user_id' => $this->integer()->null()->comment('Пользователь'),
            'body' => $this->text()->notNull()->comment('Вопрос'),
            'email' => $this->string()->null()->comment('Email'),
        ]);
    }

    /**
     * {@inheritdoc}
     */

    public function safeDown()
    {
        $this->dropTable('{{%request}}');
    }

}
