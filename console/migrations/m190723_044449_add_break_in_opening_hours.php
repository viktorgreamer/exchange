<?php

use yii\db\Migration;

/**
 * Class m190723_044449_add_break_in_opening_hours
 */
class m190723_044449_add_break_in_opening_hours extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('{{%opening_hours}}','break_time_start', $this->integer(7)->comment('Начало'));
        $this->addColumn('{{%opening_hours}}','break_time_end', $this->integer(7)->comment('Окончание'));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%opening_hours}}','break_time_start');
        $this->dropColumn('{{%opening_hours}}','break_time_end');

    }

}
