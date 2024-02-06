<?php

use Faker\Factory;
use yii\db\Migration;

/**
 * Class m240206_132737_fill_compworkers_table
 */
class m240206_132737_fill_compworkers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $faker = Factory::create();

        for ($i = 0; $i < 200; $i++)
        {
            $this->insert('compworkers', [
                'companies_id' => $faker->numberBetween(1, 100),
                'workers_id' => $faker->numberBetween(1, 100),
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return $this->truncateTable('workers');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240204_115752_fill_compworkers_table cannot be reverted.\n";

        return false;
    }
    */
}