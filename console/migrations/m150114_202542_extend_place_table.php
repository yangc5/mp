<?php

use yii\db\Schema;
use yii\db\Migration;

class m150114_202542_extend_place_table extends Migration
{
    public function up()
    {
      $tableOptions = null;
      if ($this->db->driverName === 'mysql') {
          $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
      }
      $this->addColumn('{{%place}}','slug','string NOT NULL');
      $this->addColumn('{{%place}}','website','string NOT NULL');
      $this->addColumn('{{%place}}','full_address','string NOT NULL');
      $this->addColumn('{{%place}}','vicinity','string NOT NULL');
      $this->addColumn('{{%place}}','notes','text');
    }

    public function down()
    {
      $this->dropColumn('{{%place}}','slug');
      $this->dropColumn('{{%place}}','website');
      $this->dropColumn('{{%place}}','full_address');
      $this->dropColumn('{{%place}}','vicinity');
      $this->dropColumn('{{%place}}','notes');
    }
}
