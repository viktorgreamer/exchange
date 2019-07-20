<?php

use yii\db\Migration;

/**
 * Class m190718_200328_add_pairs
 */
class m190718_200328_add_pairs extends Migration
{
    /**
     * {@inheritdoc}
     */

    public function safeUp()
    {
        $this->createTable('{{%pairs}}', [
            'id' => $this->primaryKey()->comment('id'),
            'name' => $this->string()->comment('Наименование'),
            'currency_from_id' => $this->string()->comment('С валюта'),
            'currency_to_id' => $this->string()->comment('На валюту'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%pairs}}');
    }

}
