<?php

use yii\db\Migration;

/**
 * Class m190718_201510_cities
 */
class m190718_161510_cities extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('{{%cities}}',[
            'id' => $this->primaryKey()->comment('id'),
            'name' => $this->string(256)->comment('Наименование'),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%cities}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190718_201510_cities cannot be reverted.\n";

        return false;
    }
    */
}
