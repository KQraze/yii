<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%request}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%service}}`
 */
class m250626_130359_create_request_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%request}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'service_id' => $this->integer(),
            'address' => $this->string()->notNull(),
            'contact_phone' => $this->string()->notNull(),
            'desired_datetime' => $this->dateTime()->notNull(),
            'custom_service_description' => $this->string(),
            'payment_method' => "ENUM('cash', 'card') NOT NULL",
            'status' => 'ENUM("new", "in_progress", "completed", "cancelled") DEFAULT "new"',
            'cancellation_reason' => $this->string(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-request-user_id}}',
            '{{%request}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-request-user_id}}',
            '{{%request}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

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
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-request-user_id}}',
            '{{%request}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-request-user_id}}',
            '{{%request}}'
        );

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
