<?php

use yii\db\Schema;
use yii\db\Migration;

class m141025_212656_create_meeting_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%meeting}}', [
            'id' => Schema::TYPE_PK,
            'owner_id' => Schema::TYPE_BIGINT.' NOT NULL',
            'type' => Schema::TYPE_SMALLINT.' NOT NULL DEFAULT 0',
            'message' => Schema::TYPE_TEXT.' NOT NULL DEFAULT ""',
            'template_id' => Schema::TYPE_INTEGER.' NOT NULL DEFAULT 0',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
        $this->addForeignKey('fk_meeting_owner', $this->tableName, 'owner_id', $this->tablePrefix.'user', 'id', 'CASCADE', 'CASCADE');        
    }

    public function down()
    {
 	  	  $this->dropForeignKey('fk_meeting_owner', $this->tableName);
        $this->dropTable('{{%meeting}}');
    }
}
