<?php

use yii\db\Migration;

class m180210_125306_create_table_department extends Migration
{
    public function safeUp()
    {
        $options = ($this->db->getDriverName() === 'mysql') ? 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci' : null;

        $this->createTable('{{%department}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(128)->notNull(),
            'hidden' => $this->smallInteger(1)->notNull()->defaultValue(0),
            'createdAt' => $this->dateTime()->null()->defaultValue(null),
            'updatedAt' => $this->dateTime()->null()->defaultValue(null),
        ], $options);

        $this->createIndex('hidden', '{{%department}}', ['hidden']);

        $this->addForeignKey(
            'fk-employee-to-department',
            '{{%employee}}',
            'departmentId',
            '{{%department}}',
            'id',
            'SET NULL',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-employee-to-department', '{{%employee}}');
        $this->dropTable('{{%department}}');
    }
}
