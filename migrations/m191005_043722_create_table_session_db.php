<?php

use yii\db\Migration;

/**
 * Class m191005_043722_create_table_session_db
 */
class m191005_043722_create_table_session_db extends Migration
{
    private $table = '{{%session_db}}';

    public function safeUp()
    {
        $options = ($this->db->getDriverName() === 'mysql') ? 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci' : null;

        $this->createTable($this->table, [
            'serverId' => $this->string(16)->notNull(),
            'sessionId' => $this->string(32)->notNull(),
            'expireAt' => $this->integer()->notNull(),
            'sessionData' => $this->text(),
        ], $options);

        $this->addPrimaryKey('session_pk', $this->table, ['serverId', 'sessionId']);
    }

    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}
