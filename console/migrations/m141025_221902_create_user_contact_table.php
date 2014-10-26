<?php

use yii\db\Schema;
use yii\db\Migration;

class m141025_221902_create_user_contact_table extends Migration
{
  public function up()
  {
      $tableOptions = null;
      if ($this->db->driverName === 'mysql') {
          $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
      }

      $this->createTable('{{%user_contact}}', [
          'id' => Schema::TYPE_PK,
          'user_id' => Schema::TYPE_BIGINT.' NOT NULL',
          'contact_type' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
          'info' => Schema::TYPE_STRING . ' NOT NULL',
          'details' => Schema::TYPE_TEXT . ' NOT NULL',
          'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
          'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
          'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
      ], $tableOptions);
      $this->addForeignKey('fk_user_contact_user', '{{%user_contact}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');     

  }

  public function down()
  {
      $this->dropForeignKey('fk_user_contact_user', '{{%user_contact}}');        
      $this->dropTable('{{%user_contact}}');
  }
}
