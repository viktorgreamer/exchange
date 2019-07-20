<?php

use yii\db\Migration;

/**
 * Class m190718_201510_cities
 */
class m190718_161511_regions extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('{{%regions}}',[
            'id' => $this->primaryKey()->comment('id'),
            'name' => $this->string(256)->comment('Наименование'),
            'city_id' => $this->integer()->notNull()->comment('id города')
        ]);

        $this->createIndex('idx-city_id', '{{%regions}}', 'city_id');
        $this->addForeignKey('fk-city_id-id', '{{%regions}}', 'city_id', '{{%cities}}', 'id', 'CASCADE', 'CASCADE');


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-city_id-id', '{{%regions}}');
            $this->dropTable('{{%regions}}');
    }
}
