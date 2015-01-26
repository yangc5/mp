<?php

use yii\db\Schema;
use yii\db\Migration;

class m150124_003721_create_user_setting_table extends Migration
{
  public function up()
  {
      $tableOptions = null;
      if ($this->db->driverName === 'mysql') {
          $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
      }

      $this->createTable('{{%user_setting}}', [
          'id' => Schema::TYPE_PK,
          'user_id' => Schema::TYPE_BIGINT.' NOT NULL',
          'filename' => Schema::TYPE_STRING.' NOT NULL',
          'avatar' => Schema::TYPE_STRING.' NOT NULL',
          'avatar_square' => Schema::TYPE_STRING.' NOT NULL',
          'avatar_small' => Schema::TYPE_STRING.' NOT NULL',
          'no_email' => Schema::TYPE_SMALLINT.' NOT NULL',
          // much more to add here
          'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
          'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
      ], $tableOptions);
      $this->addForeignKey('fk_user_setting_user_id', '{{%user_setting}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
  }

  public function down()
  {
      $this->dropForeignKey('fk_user_setting_user_id', '{{%user_setting}}');    
      $this->dropTable('{{%user_setting}}');
  }
}
