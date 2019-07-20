<?php

use yii\db\Migration;

/**
 * Class m190719_035703_create_table_opening_hours
 */
class m190719_035703_create_table_opening_hours extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('{{%opening_hours}}',[
            'id' => $this->primaryKey()->comment('id'),
            'exchange_point_id' => $this->integer()->comment('Точка обмена'),
            'day' => $this->integer(1)->comment('День недели'),
            'time_start' => $this->integer(7)->comment('Начало'),
            'time_end' => $this->integer(7)->comment('Окончание'),
        ]);

        $this->createIndex('idx-exchange_point_id', '{{%opening_hours}}', 'exchange_point_id');
        $this->addForeignKey('fk-exchange_point_id-id', '{{%opening_hours}}', 'exchange_point_id', '{{%exchange_points}}', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-exchange_point_id-id', '{{%opening_hours}}');
        $this->dropTable('{{%opening_hours}}');
    }

}
