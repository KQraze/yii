<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%contact}}`.
 */
class m250627_162054_create_contact_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%contact}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'phone' => $this->string()->notNull(),
            'address' => $this->string()->notNull(),
            'type' => "ENUM('organization', 'person') NOT NULL",
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%contact}}');
    }
}
