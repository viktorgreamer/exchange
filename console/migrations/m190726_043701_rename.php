<?php

use yii\db\Migration;

/**
 * Class m190726_043701_rename
 */
class m190726_043701_rename extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameTable('located_countrys', 'located_countries');

        $this->renameColumn('located_region', 'country', 'country_id');

        $this->renameColumn('located_area', 'country', 'country_id');
        $this->renameColumn('located_area', 'region', 'region_id');

        $this->renameColumn('located_village', 'country', 'country_id');
        $this->renameColumn('located_village', 'region', 'region_id');

        $this->renameColumn('located_village', 'area', 'area_id');


        $this->createIndex('idx-located_area-country_id', 'located_region', 'country_id');
        $this->addForeignKey('fk-located_area-country_id-id', 'located_region', 'country_id', 'located_countries', 'id', 'CASCADE', 'CASCADE');


        $this->createIndex('idx-located_area-region_id', 'located_area', 'region_id');
        $this->addForeignKey('fk-located_area-region_id-id', 'located_area', 'region_id', 'located_region', 'id', 'CASCADE', 'CASCADE');


        $this->createIndex('idx-located_area-country_id', 'located_area', 'country_id');
        $this->addForeignKey('fk-located_region-country_id-id', 'located_area', 'country_id', 'located_countries', 'id', 'CASCADE', 'CASCADE');


        $this->createIndex('idx-located_village-region_id', 'located_village', 'region_id');
        $this->addForeignKey('fk-located_village-region_id-id', 'located_village', 'region_id', 'located_region', 'id', 'CASCADE', 'CASCADE');


        $this->createIndex('idx-located_village-country_id', 'located_village', 'country_id');
        $this->addForeignKey('fk-located_village-country_id-id', 'located_village', 'country_id', 'located_countries', 'id', 'CASCADE', 'CASCADE');

        $this->createIndex('idx-located_village-area_id', 'located_village', 'area_id');
        $this->addForeignKey('fk-located_village-area_id-id', 'located_village', 'area_id', 'located_area', 'id', 'CASCADE', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->renameTable('located_countries', 'located_countrys');

        $this->renameColumn('located_region', 'country_id', 'country');

        $this->renameColumn('located_area', 'country_id', 'country');
        $this->renameColumn('located_area', 'region_id', 'region');


        $this->renameColumn('located_village', 'country_id', 'country');
        $this->renameColumn('located_village', 'region_id', 'region');
        $this->renameColumn('located_village', 'area_id', 'area');


        $this->dropIndex('idx-located_area-country_id', 'located_region');
        $this->dropForeignKey('fk-located_area-country_id-id', 'located_region');


        $this->dropIndex('idx-located_area-region_id', 'located_area');
        $this->dropForeignKey('fk-located_area-region_id-id', 'located_area');


        $this->dropIndex('idx-located_area-country_id', 'located_area');
        $this->dropForeignKey('fk-located_region-country_id-id', 'located_area');


        $this->dropIndex('idx-located_village-region_id', 'located_village');
        $this->dropForeignKey('fk-located_village-region_id-id', 'located_village');


        $this->dropIndex('idx-located_village-country_id', 'located_village');
        $this->dropForeignKey('fk-located_village-country_id-id', 'located_village');

        $this->dropIndex('idx-located_village-area_id', 'located_village');
        $this->dropForeignKey('fk-located_village-area_id-id', 'located_village');

    }
}
