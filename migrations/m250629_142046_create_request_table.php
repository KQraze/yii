<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%request}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%service}}`
 */
class m250629_142046_create_request_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%request}}', [
            'id' => $this->primaryKey(),
            'fio' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'date' => $this->dateTime(),
            'service_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `service_id`
        $this->createIndex(
            '{{%idx-request-service_id}}',
            '{{%request}}',
            'service_id'
        );

        // add foreign key for table `{{%service}}`
        $this->addForeignKey(
            '{{%fk-request-service_id}}',
            '{{%request}}',
            'service_id',
            '{{%service}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%service}}`
        $this->dropForeignKey(
            '{{%fk-request-service_id}}',
            '{{%request}}'
        );

        // drops index for column `service_id`
        $this->dropIndex(
            '{{%idx-request-service_id}}',
            '{{%request}}'
        );

        $this->dropTable('{{%request}}');
    }
}
