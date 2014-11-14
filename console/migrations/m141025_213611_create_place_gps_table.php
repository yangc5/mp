<?php

use yii\db\Schema;
use yii\db\Migration;

class m141025_213611_create_place_gps_table extends Migration
{
  public function up()
  {
      $tableOptions = null;
      if ($this->db->driverName === 'mysql') {
          $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=MyISAM';
      }

      $this->createTable('{{%place_gps}}', [
          'id' => Schema::TYPE_PK,
          'place_id' => Schema::TYPE_INTEGER.' NOT NULL',
          'gps'=>'POINT NOT NULL',
      ], $tableOptions);
      $this->execute('create spatial index place_gps_gps on '.'{{%place_gps}}(gps);');
      $this->addForeignKey('fk_place_gps','{{%place_gps}}' , 'place_id', '{{%place}}', 'id', 'CASCADE', 'CASCADE');
  }

  public function down()
  {
	  $this->dropForeignKey('fk_place_gps', '{{%place_gps}}');
       $this->dropIndex('place_gps_gps', '{{%place_gps}}');	  
      $this->dropTable('{{%place_gps}}');
  }
}
