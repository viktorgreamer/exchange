<?php

use yii\db\Migration;

/**
 * Class m190719_041717_create_table_reviews
 */
class m190719_041717_create_table_reviews extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%reviews}}',
            [
                'id' => $this->primaryKey()->comment('id'),
                'user_id' => $this->integer()->comment('Пользователь'),
                'created_at' => $this->integer()->notNull()->comment('Создан'),
                'status' => $this->integer(1)->null()->comment('Статус'),
                'rating_geo' => $this->integer(1)->null()->comment('Рейтинг расположения'),
                'rating_actuality' => $this->integer(1)->null()->comment('Рейтинг актуальности курса'),
                'rating_service' => $this->integer(1)->null()->comment('Рейтинг обслуживания'),
            ]);

        $this->createIndex('idx-user_id', '{{%reviews}}', 'user_id');
        $this->addForeignKey('fk-user_id-id', '{{%reviews}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%reviews}}');
    }
}
