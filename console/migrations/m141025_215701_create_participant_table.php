<?php

use yii\db\Schema;
use yii\db\Migration;

class m141025_215701_create_participant_table extends Migration
{
  public function up()
  {
      $tableOptions = null;
      if ($this->db->driverName === 'mysql') {
          $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
      }

      $this->createTable('{{%participant}}', [
          'id' => Schema::TYPE_PK,
          'meeting_id' => Schema::TYPE_INTEGER.' NOT NULL',
          'participant_id' => Schema::TYPE_BIGINT.' NOT NULL',
          'invited_by' => Schema::TYPE_BIGINT.' NOT NULL',
          'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
          'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
          'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
      ], $tableOptions);
      $this->addForeignKey('fk_participant_meeting', $this->tableName, 'meeting_id', $this->tablePrefix.'meeting', 'id', 'CASCADE', 'CASCADE');
      $this->addForeignKey('fk_participant_participant', $this->tableName, 'participant_id', $this->tablePrefix.'user', 'id', 'CASCADE', 'CASCADE');
      $this->addForeignKey('fk_participant_invited_by', $this->tableName, 'invited_by', $this->tablePrefix.'user', 'id', 'CASCADE', 'CASCADE');      
  }

  public function down()
  {
	  $this->dropForeignKey('fk_participant_invited_by', $this->tableName);
	  $this->dropForeignKey('fk_participant_participant', $this->tableName);
	  $this->dropForeignKey('fk_participant_meeting', $this->tableName);    
      $this->dropTable('{{%participant}}');
  }
}
