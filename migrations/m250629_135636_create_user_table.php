<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m250629_135636_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'fio' => $this->string()->notNull(),
            'username' => $this->string()->unique()->notNull(),
            'password' => $this->string()->notNull(),
        ]);

        $this->insert('user', [
            'fio' => 'Админ',
            'username' => 'admin',
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
