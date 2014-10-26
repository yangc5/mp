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
      $this->addForeignKey('fk_template_place_template', '{{%template_place}}', 'template_id', '{{%template}}', 'id', 'CASCADE', 'CASCADE');        
      $this->addForeignKey('fk_template_place_place', '{{%template_place}}', 'place_id', '{{%place}}', 'id', 'CASCADE', 'CASCADE');        
  }

  public function down()
  {
    $this->dropForeignKey('fk_template_place_place', '{{%template_place}}');        
    $this->dropForeignKey('fk_template_place_template', '{{%template_place}}');            
      $this->dropTable('{{%template_place}}');
  }
}
