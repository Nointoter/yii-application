<?php

use yii\db\Migration;

/**
 * Class m240206_132631_fill_cities_table
 */
class m240206_132631_fill_cities_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240206_132631_fill_cities_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240206_132631_fill_cities_table cannot be reverted.\n";

        return false;
    }
    */
}
