<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m250627_095135_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'full_name' => $this->string(70)->notNull(),
            'login' => $this->string(70)->notNull()->unique(),
            'password' => $this->string()->notNull(),
        ]);

        $this->insert('{{%user}}', [
            'full_name' => 'Руководитель',
            'login' => 'admin',
            'password' => md5('admin'),
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
