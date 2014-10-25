<?php

use yii\db\Schema;
use yii\db\Migration;

class m141025_222431_create_template_time_table extends Migration
{
  public function up()
  {
      $tableOptions = null;
      if ($this->db->driverName === 'mysql') {
          $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
      }

      $this->createTable('{{%template_time}}', [
          'id' => Schema::TYPE_PK,
          'template_id' => Schema::TYPE_INTEGER.' NOT NULL',
          'day' => Schema::TYPE_SMALLINT.' NOT NULL DEFAULT 0',
          'hour' => Schema::TYPE_SMALLINT.' NOT NULL DEFAULT 0',
          'minute' => Schema::TYPE_SMALLINT.' NOT NULL DEFAULT 0',
          'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
          'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
      ], $tableOptions);
  }

  public function down()
  {
      $this->dropTable('{{%template_time}}');
  } 
}
