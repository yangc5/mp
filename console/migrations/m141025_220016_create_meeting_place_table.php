<?php

use yii\db\Schema;
use yii\db\Migration;

class m141025_220016_create_meeting_place_table extends Migration
{
  public function up()
  {
      $tableOptions = null;
      if ($this->db->driverName === 'mysql') {
          $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
      }

      $this->createTable('{{%meeting_place}}', [
          'id' => Schema::TYPE_PK,
          'meeting_id' => Schema::TYPE_INTEGER.' NOT NULL',
          'place_id' => Schema::TYPE_INTEGER.' NOT NULL',
          'suggested_by' => Schema::TYPE_BIGINT.' NOT NULL',
          'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
          'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
          'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
      ], $tableOptions);
      $this->addForeignKey('fk_meeting_place_meeting', '{{%meeting_place}}', 'meeting_id', '{{%meeting}}', 'id', 'CASCADE', 'CASCADE');
      $this->addForeignKey('fk_meeting_place_place', '{{%meeting_place}}', 'place_id', '{{%place}}', 'id', 'CASCADE', 'CASCADE');
      $this->addForeignKey('fk_meeting_suggested_by', '{{%meeting_place}}', 'suggested_by', '{{%user}}', 'id', 'CASCADE', 'CASCADE');     

  }

  public function down()
  {
    $this->dropForeignKey('fk_meeting_suggested_by', '{{%meeting_place}}');
      $this->dropForeignKey('fk_meeting_place_meeting', '{{%meeting_place}}');    
      $this->dropTable('{{%meeting_place}}');
  }
}
