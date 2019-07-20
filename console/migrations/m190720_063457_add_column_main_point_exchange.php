<?php

use yii\db\Migration;

/**
 * Class m190720_063457_add_column_main_point_exchange
 */
class m190720_063457_add_column_main_point_exchange extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {


        $this->addColumn('{{%exchange_points}}', 'main', $this->boolean()->comment('Главная точка'));


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%exchange_points}}', 'main');

    }

}
