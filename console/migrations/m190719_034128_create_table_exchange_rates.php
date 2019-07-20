<?php

use yii\db\Migration;

/**
 * Class m190719_034128_create_table_exchange_rates
 */
class m190719_034128_create_table_exchange_rates extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%exchange_rates}}', [
            'id' => $this->primaryKey()->comment('id'),
            'point_id' => $this->integer()->comment('Точка обмена'),
            'pair_id' => $this->integer()->comment('Валюты'),
            'status' => $this->integer(1)->comment('Статус'),
            'buy' => $this->float(2)->comment('Цена покупки'),
            'sell' => $this->float(2)->comment('Цена прожи'),
            'created_at' => $this->integer()->notNull()->comment('Создан в'),
            'updated_at' => $this->integer()->notNull()->comment('Обновлен в')
        ]);

        $this->createIndex('idx-point_id', '{{%exchange_rates}}', 'point_id');
        $this->addForeignKey('fk-point_id-id', '{{%exchange_rates}}', 'point_id', '{{%exchange_points}}', 'id', 'CASCADE', 'CASCADE');

        $this->createIndex('idx-pair_id', '{{%exchange_rates}}', 'pair_id');
        $this->addForeignKey('fk-pair_id-id', '{{%exchange_rates}}', 'pair_id', '{{%pairs}}', 'id', 'CASCADE', 'CASCADE');


    }

    /**
     * {@inheritdoc}
     */

    public function safeDown()
    {
        $this->dropForeignKey('fk-entity_id-id', '{{%exchange_rates}}');
        $this->dropForeignKey('fk-pair_id-id', '{{%exchange_rates}}');
        $this->dropTable('{{%exchange_rates}}');
    }


}
