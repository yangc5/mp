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
          'type' => Schema::TYPE_SMALLINT.' NOT NULL DEFAULT 0',
          'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
          'is_private' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
          'gps'=>'POINT NOT NULL',
          'ext_id' => Schema::TYPE_STRING.' NOT NULL', // e.g. google places id
          'ext_reference' => Schema::TYPE_TEXT, // e.g. google places reference                   
          'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
          'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
      ], $tableOptions);
      $this->execute('create spatial index place_gps on '.$this->tablePrefix.'place(gps);');
  }

  public function down()
  {
    $this->dropIndex('place_gps', $this->tableName);	  
      $this->dropTable('{{%place}}');
  }
}
