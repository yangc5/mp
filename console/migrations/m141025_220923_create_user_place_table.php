<?php

use yii\db\Schema;
use yii\db\Migration;

class m141025_220923_create_user_place_table extends Migration
{
  public function up()
  {
      $tableOptions = null;
      if ($this->db->driverName === 'mysql') {
          $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
      }

      $this->createTable('{{%user_place}}', [
          'id' => Schema::TYPE_PK,
          'user_id' => Schema::TYPE_BIGINT.' NOT NULL',
          'place_id' => Schema::TYPE_BIGINT.' NOT NULL',
          'is_favorite' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
          'number_meetings' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
          'is_special' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
          'note' => Schema::TYPE_STRING . ' NOT NULL',
          'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
          'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
          'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
      ], $tableOptions);
  }

  public function down()
  {
      $this->dropTable('{{%user_place}}');
  }
}
