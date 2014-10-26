<?php

use yii\db\Schema;
use yii\db\Migration;

class m141025_220524_create_contact_table extends Migration
{
  public function up()
  {
      $tableOptions = null;
      if ($this->db->driverName === 'mysql') {
          $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
      }

      $this->createTable('{{%contact}}', [
          'id' => Schema::TYPE_PK,
          'user_id' => Schema::TYPE_BIGINT.' NOT NULL',
          'friend_id' => Schema::TYPE_BIGINT.' NOT NULL',
          'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
          'number_meetings' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
          'is_favorite' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
          'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
          'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
      ], $tableOptions);
      $this->addForeignKey('fk_contact_user_id', '{{%contact}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');     
      $this->addForeignKey('fk_contact_friend_id', '{{%contact}}', 'friend_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');     

  }

  public function down()
  {
    $this->dropForeignKey('fk_contact_friend_id', '{{%contact}}');    
    $this->dropForeignKey('fk_contact_user_id', '{{%contact}}');        
      $this->dropTable('{{%contact}}');
  }
}
