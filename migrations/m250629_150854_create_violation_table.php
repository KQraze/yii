<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%violation}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%car}}`
 */
class m250629_150854_create_violation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%violation}}', [
            'id' => $this->primaryKey(),
            'date' => $this->dateTime()->notNull(),
            'type' => "ENUM('Превышение скорости', 'Проезд на красный') NOT NULL",
            'price' => $this->integer()->notNull(),
            'car_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `car_id`
        $this->createIndex(
            '{{%idx-violation-car_id}}',
            '{{%violation}}',
            'car_id'
        );

        // add foreign key for table `{{%car}}`
        $this->addForeignKey(
            '{{%fk-violation-car_id}}',
            '{{%violation}}',
            'car_id',
            '{{%car}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%car}}`
        $this->dropForeignKey(
            '{{%fk-violation-car_id}}',
            '{{%violation}}'
        );

        // drops index for column `car_id`
        $this->dropIndex(
            '{{%idx-violation-car_id}}',
            '{{%violation}}'
        );

        $this->dropTable('{{%violation}}');
    }
}
