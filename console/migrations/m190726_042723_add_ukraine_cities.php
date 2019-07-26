<?php

use yii\db\Migration;

/**
 * Class m190726_042723_add_ukraine_cities
 */
class m190726_042723_add_ukraine_cities extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->execute(file_get_contents(Yii::getAlias('@app') . '/migrations/ukraine_cities.sql'));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('located_area');
        $this->dropTable('located_countrys');
        $this->dropTable('located_region');
        $this->dropTable('located_village');

    }

}
