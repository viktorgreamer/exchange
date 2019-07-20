<?php

use yii\db\Migration;

/**
 * Class m190719_181931_add_column_description_currencies
 */
class m190719_181931_add_column_description_currencies extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%currencies}}', 'mark', $this->string(10)->notNull()->comment('Краткое обозначение'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%currencies}}', 'mark');
    }

}
