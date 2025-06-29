<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%request}}`.
 */
class m250629_143944_add_status_column_to_request_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%request}}', 'status', $this->boolean()->defaultValue(false));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%request}}', 'status');
    }
}
