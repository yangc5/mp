<?php

use yii\db\Schema;
use yii\db\Migration;

class m141025_221627_create_meeting_note_table extends Migration
{
  public function up()
  {
      $tableOptions = null;
      if ($this->db->driverName === 'mysql') {
          $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
      }

      $this->createTable('{{%meeting_note}}', [
          'id' => Schema::TYPE_PK,
          'meeting_id' => Schema::TYPE_INTEGER.' NOT NULL',
          'posted_by' => Schema::TYPE_BIGINT.' NOT NULL DEFAULT 0',
          'note' => Schema::TYPE_TEXT.' NOT NULL DEFAULT ""',
          'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
          'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
          'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
      ], $tableOptions);
      $this->addForeignKey('fk_meeting_note_meeting', '{{%meeting_note}}', 'meeting_id', '{{%meeting}}', 'id', 'CASCADE', 'CASCADE');
      $this->addForeignKey('fk_meeting_note_posted_by', '{{%meeting_note}}', 'posted_by', '{{%user}}', 'id', 'CASCADE', 'CASCADE');     

  }

  public function down()
  {
      $this->dropForeignKey('fk_meeting_note_posted_by', '{{%meeting_note}}');    
      $this->dropForeignKey('fk_meeting_note_meeting', '{{%meeting_note}}');    
      $this->dropTable('{{%meeting_note}}');
  }
}
