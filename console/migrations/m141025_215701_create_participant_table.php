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
      $this->addForeignKey('fk_participant_meeting', '{{%participant}}', 'meeting_id', '{{%meeting}}', 'id', 'CASCADE', 'CASCADE');
      $this->addForeignKey('fk_participant_participant', '{{%participant}}', 'participant_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
      $this->addForeignKey('fk_participant_invited_by', '{{%participant}}', 'invited_by', '{{%user}}', 'id', 'CASCADE', 'CASCADE');      
  }

  public function down()
  {
	  $this->dropForeignKey('fk_participant_invited_by', '{{%participant}}');
	  $this->dropForeignKey('fk_participant_participant', '{{%participant}}');
	  $this->dropForeignKey('fk_participant_meeting', '{{%participant}}');    
      $this->dropTable('{{%participant}}');
  }
}
