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
            'meeting_type' => Schema::TYPE_SMALLINT.' NOT NULL DEFAULT 0',
            'message' => Schema::TYPE_TEXT.' NOT NULL DEFAULT ""',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
        $this->addForeignKey('fk_meeting_owner', '{{%meeting}}', 'owner_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');        
    }

    public function down()
    {
 	  	$this->dropForeignKey('fk_meeting_owner', '{{%meeting}}');
        $this->dropTable('{{%meeting}}');
    }
}
