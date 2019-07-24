<?php

use yii\db\Migration;

/**
 * Class m190720_063457_add_column_main_point_exchange
 */
class m190724_073457_add_columns_point_exchange extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {


        $this->addColumn('{{%exchange_points}}', 'email', $this->string(256)->comment('Email'));
        $this->addColumn('{{%exchange_points}}', 'skype', $this->string(256)->comment('Skype'));
        $this->addColumn('{{%exchange_points}}', 'viber', $this->string(256)->comment('Viber'));
        $this->addColumn('{{%exchange_points}}', 'telegram', $this->string(256)->comment('Telegram'));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%exchange_points}}', 'email');
        $this->dropColumn('{{%exchange_points}}', 'skype');
        $this->dropColumn('{{%exchange_points}}', 'viber');
        $this->dropColumn('{{%exchange_points}}', 'telegram');

    }

}
