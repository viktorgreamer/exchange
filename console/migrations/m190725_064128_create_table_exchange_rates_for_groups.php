<?php

use yii\db\Migration;

/**
 * Class m190719_034128_create_table_exchange_rates
 */
class m190725_064128_create_table_exchange_rates_for_groups extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%group_exchange_rates}}', [
            'id' => $this->primaryKey()->comment('id'),
            'group_id' => $this->integer()->comment('Пункт обмена'),
            'pair_id' => $this->integer()->comment('Валюты'),
            'status' => $this->integer(1)->comment('Статус'),
            'buy' => $this->float(2)->comment('Цена покупки'),
            'sell' => $this->float(2)->comment('Цена продажи'),
            'created_at' => $this->integer()->notNull()->comment('Создан в'),
            'updated_at' => $this->integer()->notNull()->comment('Обновлен в')
        ]);

        $this->createIndex('idx-group_exchange_rates-group_id', '{{%group_exchange_rates}}', 'group_id');
        $this->addForeignKey('fk-group_exchange_rates-group_id-id', '{{%group_exchange_rates}}', 'group_id', '{{%exchange_rates_groups}}', 'id', 'CASCADE', 'CASCADE');

        $this->createIndex('idx-group_exchange_rates-pair_id', '{{%group_exchange_rates}}', 'pair_id');
        $this->addForeignKey('fk--group_exchange_rates-pair_id-id', '{{%group_exchange_rates}}', 'pair_id', '{{%pairs}}', 'id', 'CASCADE', 'CASCADE');


    }

    /**
     * {@inheritdoc}
     */

    public function safeDown()
    {
        $this->dropForeignKey('fk--group_exchange_rates-pair_id-id', '{{%group_exchange_rates}}');
        $this->dropForeignKey('fk-group_exchange_rates-group_id-id', '{{%group_exchange_rates}}');
        $this->dropTable('{{%group_exchange_rates}}');
    }

}
