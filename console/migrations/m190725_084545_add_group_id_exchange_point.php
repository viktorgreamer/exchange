<?php

use yii\db\Migration;

/**
 * Class m190718_190119_add_exchange_point
 */
class m190725_084545_add_group_id_exchange_point extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%exchange_points}}', 'group_id', $this->integer()->null()->comment('Группа курсов'));

        $this->createIndex('idx-exchange_points-group_id', '{{%exchange_points}}', 'group_id');
        $this->addForeignKey('fk-exchange_points-group_id-id', '{{%exchange_points}}', 'group_id', '{{%exchange_rates_groups}}', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-exchange_points-group_id-id', '{{%exchange_points}}');
        $this->dropColumn('{{%exchange_points}}', 'group_id');
    }

}
