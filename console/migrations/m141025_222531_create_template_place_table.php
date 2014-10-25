<?php

use yii\db\Schema;
use yii\db\Migration;

class m141025_222531_create_template_place_table extends Migration
{
  public function up()
  {
      $tableOptions = null;
      if ($this->db->driverName === 'mysql') {
          $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
      }

      $this->createTable('{{%template_place}}', [
          'id' => Schema::TYPE_PK,
          'template_id' => Schema::TYPE_INTEGER.' NOT NULL',
          'place_id' => Schema::TYPE_INTEGER.' NOT NULL',
          'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
          'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
      ], $tableOptions);
  }

  public function down()
  {
      $this->dropTable('{{%template_place}}');
  }
}
