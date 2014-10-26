<?php

use yii\db\Schema;
use yii\db\Migration;

class m141025_222213_create_template_table extends Migration
{
  public function up()
  {
      $tableOptions = null;
      if ($this->db->driverName === 'mysql') {
          $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
      }

      $this->createTable('{{%template}}', [
          'id' => Schema::TYPE_PK,
          'owner_id' => Schema::TYPE_BIGINT.' NOT NULL',
          'name' => Schema::TYPE_STRING.' NOT NULL',
          'meeting_type' => Schema::TYPE_SMALLINT.' NOT NULL DEFAULT 0',
          'message' => Schema::TYPE_TEXT.' NOT NULL DEFAULT ""',
          'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
          'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
          'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
      ], $tableOptions);
      $this->addForeignKey('fk_template_owner', '{{%template}}', 'owner_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');        

  }

  public function down()
  {
    $this->dropForeignKey('fk_template_owner', '{{%template}}');        
      $this->dropTable('{{%template}}');
  }
}
