<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%workers}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%cities}}`
 */
class m240206_132605_create_workers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%workers}}', [
            'id' => $this->primaryKey(),
            'cities_id' => $this->integer()->notNull(),
            'name' => $this->string(),
            'surname' => $this->text(),
        ]);

        // creates index for column `cities_id`
        $this->createIndex(
            '{{%idx-workers-cities_id}}',
            '{{%workers}}',
            'cities_id'
        );

        // add foreign key for table `{{%cities}}`
        $this->addForeignKey(
            '{{%fk-workers-cities_id}}',
            '{{%workers}}',
            'cities_id',
            '{{%cities}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%cities}}`
        $this->dropForeignKey(
            '{{%fk-workers-cities_id}}',
            '{{%workers}}'
        );

        // drops index for column `cities_id`
        $this->dropIndex(
            '{{%idx-workers-cities_id}}',
            '{{%workers}}'
        );

        $this->dropTable('{{%workers}}');
    }
}
