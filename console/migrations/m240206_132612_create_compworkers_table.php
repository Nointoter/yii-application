<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%compworkers}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%companies}}`
 * - `{{%workers}}`
 */
class m240206_132612_create_compworkers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%compworkers}}', [
            'id' => $this->primaryKey(),
            'companies_id' => $this->integer()->notNull(),
            'workers_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `companies_id`
        $this->createIndex(
            '{{%idx-compworkers-companies_id}}',
            '{{%compworkers}}',
            'companies_id'
        );

        // add foreign key for table `{{%companies}}`
        $this->addForeignKey(
            '{{%fk-compworkers-companies_id}}',
            '{{%compworkers}}',
            'companies_id',
            '{{%companies}}',
            'id',
            'CASCADE'
        );

        // creates index for column `workers_id`
        $this->createIndex(
            '{{%idx-compworkers-workers_id}}',
            '{{%compworkers}}',
            'workers_id'
        );

        // add foreign key for table `{{%workers}}`
        $this->addForeignKey(
            '{{%fk-compworkers-workers_id}}',
            '{{%compworkers}}',
            'workers_id',
            '{{%workers}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%companies}}`
        $this->dropForeignKey(
            '{{%fk-compworkers-companies_id}}',
            '{{%compworkers}}'
        );

        // drops index for column `companies_id`
        $this->dropIndex(
            '{{%idx-compworkers-companies_id}}',
            '{{%compworkers}}'
        );

        // drops foreign key for table `{{%workers}}`
        $this->dropForeignKey(
            '{{%fk-compworkers-workers_id}}',
            '{{%compworkers}}'
        );

        // drops index for column `workers_id`
        $this->dropIndex(
            '{{%idx-compworkers-workers_id}}',
            '{{%compworkers}}'
        );

        $this->dropTable('{{%compworkers}}');
    }
}
