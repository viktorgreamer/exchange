<?php

use yii\db\Migration;

/**
 * Class m190718_190119_add_exchange_point
 */
class m190718_190119_add_exchange_point extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%exchange_points}}',
            [
                'id' => $this->primaryKey()->comment('id'),
                'address' => $this->string(256)->comment('Адрес'),
                'latitude' => $this->float(7)->comment('Широта'),
                'longitude' => $this->float(7)->comment('Долгота'),
                'entity_id' => $this->integer()->notNull()->comment('Юрлицо'),
                'city_id' => $this->integer()->notNull()->comment('Город'),
                'region_id' => $this->integer()->notNull()->comment('Район'),
                'phone1' => $this->string(20)->null()->comment('Телефон1'),
                'phone2' => $this->string(20)->null()->comment('Телефон2'),
                'name' => $this->string(256)->null()->comment('Наименование'),
                'link' => $this->string(256)->null()->comment('Ссылка на сайт'),
                'status' => $this->integer(1)->null()->comment('Статус'),
                'rating' => $this->float(1)->null()->comment('Рейтинг'),
                'rating_geo' => $this->float(1)->null()->comment('Рейтинг расположения'),
                'rating_actuality' => $this->float(1)->null()->comment('Рейтинг актуальности курса'),
                'rating_service' => $this->float(1)->null()->comment('Рейтинг обслуживания'),
            ]);

        $this->createIndex('idx-exchange_points-entity_id', '{{%exchange_points}}', 'entity_id');
        $this->addForeignKey('fk-exchange_points-entity_id-id', '{{%exchange_points}}', 'entity_id', '{{%entities}}', 'id', 'CASCADE', 'CASCADE');

        $this->createIndex('idx-exchange_points-city_id', '{{%exchange_points}}', 'city_id');
        $this->addForeignKey('fk-exchange_points-city_id-id', '{{%exchange_points}}', 'city_id', '{{%cities}}', 'id', 'CASCADE', 'CASCADE');

        $this->createIndex('idx-exchange_points-region_id', '{{%exchange_points}}', 'region_id');
        $this->addForeignKey('fk-exchange_points-region_id-id', '{{%exchange_points}}', 'region_id', '{{%regions}}', 'id', 'CASCADE', 'CASCADE');


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-exchange_points-entity_id-id', '{{%exchange_points}}');
        $this->dropForeignKey('fk-exchange_points-city_id-id', '{{%exchange_points}}');
        $this->dropForeignKey('fk-exchange_points-region_id-id', '{{%exchange_points}}');
        $this->dropTable('{{%exchange_points}}');
    }

}
