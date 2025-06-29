<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%employee}}`.
 */
class m250629_140017_create_employee_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%employee}}', [
            'id' => $this->primaryKey(),
            'fio' => $this->string()->notNull(),
            'gender' => $this->string()->notNull(),
            'age' => $this->integer()->notNull(),
            'family_status' => $this->string()->notNull(),
            'children' => $this->boolean(),
            'position' => $this->string()->notNull(),
            'degree' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%employee}}');
    }
}
