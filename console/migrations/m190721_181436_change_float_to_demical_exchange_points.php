<?php

use yii\db\Migration;

/**
 * Class m190721_181436_change_float_to_demical_exchange_points
 */
class m190721_181436_change_float_to_demical_exchange_points extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->alterColumn('{{%exchange_points}}', 'latitude', $this->decimal(10, 7)->comment('Широта'));
        $this->alterColumn('{{%exchange_points}}', 'longitude', $this->decimal(10, 7)->comment('Долгота'));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('{{%exchange_points}}', 'latitude', $this->float(7)->comment('Широта'));
        $this->alterColumn('{{%exchange_points}}', 'longitude', $this->float(7)->comment('Долгота'));

    }
}
