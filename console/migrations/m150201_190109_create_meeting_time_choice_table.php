<?php

use yii\db\Schema;
use yii\db\Migration;

class m150201_190109_create_meeting_time_choice_table extends Migration
{
  public function up()
  {
      $tableOptions = null;
      if ($this->db->driverName === 'mysql') {
          $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
      }

      $this->createTable('{{%meeting_time_choice}}', [
          'id' => Schema::TYPE_PK,
          'meeting_time_id' => Schema::TYPE_INTEGER.' NOT NULL',
          'user_id' => Schema::TYPE_BIGINT.' NOT NULL',
          'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
          'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
          'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
      ], $tableOptions);
      $this->addForeignKey('fk_mtc_meeting_time', '{{%meeting_time_choice}}', 'meeting_time_id', '{{%meeting_time}}', 'id', 'CASCADE', 'CASCADE');
      $this->addForeignKey('fk_mtc_user_id', '{{%meeting_time_choice}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');      
      
  }

  public function down()
  {
    $this->dropForeignKey('fk_mtc_user_id', '{{%meeting_time_choice}}');
    $this->dropForeignKey('fk_mtc_meeting_time', '{{%meeting_time_choice}}');
    $this->dropTable('{{%meeting_time_choice}}');
  }
}
