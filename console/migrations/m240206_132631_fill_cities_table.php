<?php

use Faker\Factory;
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
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++)
        {
            $this->insert('cities', [
                'name' => $faker->city(30),
                'region_number' => $faker->numberBetween(1, 159),
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return $this->truncateTable('cities');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240204_095848_fill_cities_table cannot be reverted.\n";

        return false;
    }
    */
}