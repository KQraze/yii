<?php

use yii\db\Migration;

/**
 * Handles dropping columns from table `{{%event}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m250627_164026_drop_user_id_column_from_event_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
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

        $this->dropColumn('{{%event}}', 'user_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%event}}', 'user_id', $this->integer()->notNull());

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
}
