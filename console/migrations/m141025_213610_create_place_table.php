<?php

use yii\db\Schema;
use yii\db\Migration;

class m141025_213610_create_place_table extends Migration
{
  public function up()
  {
      $tableOptions = null;
      if ($this->db->driverName === 'mysql') {
          $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
      }

      $this->createTable('{{%place}}', [
          'id' => Schema::TYPE_PK,
          'name' => Schema::TYPE_STRING.' NOT NULL',          
          'place_type' => Schema::TYPE_SMALLINT.' NOT NULL DEFAULT 0',
          'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
          'google_place_id' => Schema::TYPE_STRING.' NOT NULL', // e.g. google places id
          'created_by' => Schema::TYPE_BIGINT.' NOT NULL',
          'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
          'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
      ], $tableOptions);
      $this->addForeignKey('fk_place_created_by', '{{%place}}', 'created_by', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
  }

  public function down()
  {
    $this->dropForeignKey('fk_place_created_by', '{{%place}}');    
      $this->dropTable('{{%place}}');
  }
}
