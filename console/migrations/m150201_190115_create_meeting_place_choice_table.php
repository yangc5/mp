<?php

use yii\db\Schema;
use yii\db\Migration;

class m150201_190115_create_meeting_place_choice_table extends Migration
{
  public function up()
  {
      $tableOptions = null;
      if ($this->db->driverName === 'mysql') {
          $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
      }

      $this->createTable('{{%meeting_place_choice}}', [
          'id' => Schema::TYPE_PK,
          'meeting_place_id' => Schema::TYPE_INTEGER.' NOT NULL',
          'user_id' => Schema::TYPE_BIGINT.' NOT NULL',
          'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
          'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
          'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
      ], $tableOptions);
      $this->addForeignKey('fk_mpc_meeting_place', '{{%meeting_place_choice}}', 'meeting_place_id', '{{%meeting_place}}', 'id', 'CASCADE', 'CASCADE');
      $this->addForeignKey('fk_mpc_user_id', '{{%meeting_place_choice}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');      
      
  }

  public function down()
  {
    $this->dropForeignKey('fk_mpc_user_id', '{{%meeting_place_choice}}');
    $this->dropForeignKey('fk_mpc_meeting_place', '{{%meeting_place_choice}}');
    $this->dropTable('{{%meeting_place_choice}}');
  }
}
