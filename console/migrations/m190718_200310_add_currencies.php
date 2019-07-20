<?php

use yii\db\Migration;

/**
 * Class m190718_200328_add_pairs
 */
class m190718_200310_add_currencies extends Migration
{
    /**
     * {@inheritdoc}
     */

    public function safeUp()
    {
        $this->createTable('{{%currencies}}', [
            'id' => $this->primaryKey()->comment('id'),
            'name' => $this->string()->comment('Наименование'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%currencies}}');
    }

}
