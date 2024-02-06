<?php

use yii\db\Migration;

/**
 * Class m240206_132730_fill_workers_table
 */
class m240206_132730_fill_workers_table extends Migration
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
        echo "m240206_132730_fill_workers_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240206_132730_fill_workers_table cannot be reverted.\n";

        return false;
    }
    */
}
