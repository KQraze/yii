<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%service}}`.
 */
class m250629_141914_create_service_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%service}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'price' => $this->integer()->notNull(),
        ]);

        $this->batchInsert('{{%service}}', ['name', 'price'], [
            ['Чистка ковров', 1000],
            ['Чистка телефонов', 300],
            ['Чистка обуви', 5000],
            ['Чистка зубов', 200],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%service}}');
    }
}
