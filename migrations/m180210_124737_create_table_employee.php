<?php

use yii\db\Migration;

class m180210_124737_create_table_employee extends Migration
{
    public function safeUp()
    {
        $options = ($this->db->getDriverName() === 'mysql') ? 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci' : null;

        $this->createTable('{{%employee}}', [
            'id' => $this->primaryKey(),
            'departmentId' => $this->integer()->null()->defaultValue(null),
            'pin' => $this->string(4)->notNull(),
            'name' => $this->string(128)->notNull(),
            'email' => $this->string(256)->notNull(),
            'phone' => $this->string(16)->null()->defaultValue(null),
            'address' => $this->string(256)->null()->defaultValue(null),
            'status' => $this->smallInteger(1)->notNull()->defaultValue(1),
            'createdAt' => $this->dateTime()->null()->defaultValue(null),
            'updatedAt' => $this->dateTime()->null()->defaultValue(null),
        ], $options);

        $this->createIndex('departmentId', '{{%employee}}', ['departmentId']);
        $this->createIndex('status', '{{%employee}}', ['status']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%employee}}');
    }
}
