<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%event}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%contact}}`
 * - `{{%user}}`
 */
class m250627_162621_create_event_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%event}}', [
            'id' => $this->primaryKey(),
            'date' => $this->dateTime()->notNull(),
            'title' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
            'contact_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `contact_id`
        $this->createIndex(
            '{{%idx-event-contact_id}}',
            '{{%event}}',
            'contact_id'
        );

        // add foreign key for table `{{%contact}}`
        $this->addForeignKey(
            '{{%fk-event-contact_id}}',
            '{{%event}}',
            'contact_id',
            '{{%contact}}',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-event-user_id}}',
            '{{%event}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-event-user_id}}',
            '{{%event}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%contact}}`
        $this->dropForeignKey(
            '{{%fk-event-contact_id}}',
            '{{%event}}'
        );

        // drops index for column `contact_id`
        $this->dropIndex(
            '{{%idx-event-contact_id}}',
            '{{%event}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-event-user_id}}',
            '{{%event}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-event-user_id}}',
            '{{%event}}'
        );

        $this->dropTable('{{%event}}');
    }
}
