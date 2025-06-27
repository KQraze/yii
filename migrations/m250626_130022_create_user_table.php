<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m250626_130022_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'full_name' => $this->string(100)->notNull(),
            'phone' => $this->string(20)->notNull(),
            'email' => $this->string(100)->notNull(),
            'username' => $this->string(100)->notNull()->unique(),
            'password' => $this->string()->notNull(),
            'role' => "ENUM('admin', 'user') NOT NULL DEFAULT 'user'",
        ]);

        $this->insert('{{%user}}', [
            'full_name' => 'admin',
            'phone' => '+7(999)999-99-99',
            'email' => 'admin@admin.com',
            'username' => 'admin',
            'password' => md5('password'),
            'role' => 'admin',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
