<?php

use yii\db\Schema;
use yii\db\Migration;

class m141025_220133_create_meeting_log_table extends Migration
{
  public function up()
  {
      $tableOptions = null;
      if ($this->db->driverName === 'mysql') {
          $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
      }

      $this->createTable('{{%meeting_log}}', [
          'id' => Schema::TYPE_PK,
          'meeting_id' => Schema::TYPE_INTEGER.' NOT NULL',
          'action' => Schema::TYPE_INTEGER.' NOT NULL',
          'actor_id' => Schema::TYPE_BIGINT.' NOT NULL',
          'item_id' => Schema::TYPE_INTEGER.' NOT NULL',
          'extra_id' => Schema::TYPE_INTEGER.' NOT NULL',
          'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
          'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
      ], $tableOptions);
      $this->addForeignKey('fk_meeting_log_meeting', '{{%meeting_log}}', 'meeting_id', '{{%meeting}}', 'id', 'CASCADE', 'CASCADE');
      $this->addForeignKey('fk_meeting_log_actor', '{{%meeting_log}}', 'actor_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');

  }

  public function down()
  {
    $this->dropForeignKey('fk_meeting_log_actor', '{{%meeting_log}}');    
    $this->dropForeignKey('fk_meeting_log_meeting', '{{%meeting_log}}');    
    
      $this->dropTable('{{%meeting_log}}');
  }
}
