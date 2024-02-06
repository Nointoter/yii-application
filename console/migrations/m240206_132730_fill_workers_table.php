<?php

use Faker\Factory;
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
        $faker = Factory::create();

        for ($i = 0; $i < 100; $i++)
        {
            $this->insert('workers', [
                'cities_id' => $faker->numberBetween(1, 10),
                'name' => $faker->firstName(30),
                'surname' => $faker->lastName(50),
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
        echo "m240204_115357_fill_workers_table cannot be reverted.\n";

        return false;
    }
    */
}