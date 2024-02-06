<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%companies}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%cities}}`
 */
class m240206_132558_create_companies_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%companies}}', [
            'id' => $this->primaryKey(),
            'cities_id' => $this->integer()->notNull(),
            'name' => $this->string(),
            'info' => $this->text(),
        ]);

        // creates index for column `cities_id`
        $this->createIndex(
            '{{%idx-companies-cities_id}}',
            '{{%companies}}',
            'cities_id'
        );

        // add foreign key for table `{{%cities}}`
        $this->addForeignKey(
            '{{%fk-companies-cities_id}}',
            '{{%companies}}',
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
            '{{%fk-companies-cities_id}}',
            '{{%companies}}'
        );

        // drops index for column `cities_id`
        $this->dropIndex(
            '{{%idx-companies-cities_id}}',
            '{{%companies}}'
        );

        $this->dropTable('{{%companies}}');
    }
}
