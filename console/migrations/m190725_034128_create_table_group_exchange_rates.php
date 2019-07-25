<?php

use yii\db\Migration;

/**
 * Class m190719_034128_create_table_exchange_rates
 */
class m190725_034128_create_table_group_exchange_rates extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%exchange_rates_groups}}', [
            'id' => $this->primaryKey()->comment('id'),
            'name' => $this->string(256)->comment('Название'),
            'entity_id' => $this->integer()->comment('Компания'),
        ]);

        $this->createIndex('idx-group_point_id', '{{%exchange_rates_groups}}', 'entity_id');
        $this->addForeignKey('fk-group_point_id', '{{%exchange_rates_groups}}', 'entity_id', '{{%entities}}', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */

    public function safeDown()
    {
        $this->dropForeignKey('fk-group_point_id', '{{%exchange_rates_groups}}');
        $this->dropTable('{{%exchange_rates_group}}');
    }


}
