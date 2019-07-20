<?php

use yii\db\Migration;

/**
 * Class m190719_184236_fix_currency_id_type
 */
class m190719_184236_fix_currency_id extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->alterColumn('{{%pairs}}','currency_from_id' , $this->integer(3)->comment('С валюта'));
        $this->alterColumn('{{%pairs}}','currency_to_id' , $this->integer(3)->comment('С валюта'));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('{{%pairs}}','currency_from_id' , $this->string()->comment('С валюта'));
        $this->alterColumn('{{%pairs}}','currency_to_id' , $this->string()->comment('С валюта'));

    }
}
