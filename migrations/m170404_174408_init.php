<?php

use yii\db\Schema;
use yii\db\Migration;

class m170404_174408_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ingredient}}', [
                'id'                    => Schema::TYPE_PK, 
                'ingred_name'           => Schema::TYPE_STRING . ' NOT NULL',
                'hidden'                => Schema::TYPE_BOOLEAN . ' DEFAULT FALSE',
            ], $tableOptions
        );

        $this->createTable('{{%bludo}}', [
                'id'                    => Schema::TYPE_PK, 
                'bludo_name'             => Schema::TYPE_STRING . ' NOT NULL',
                'hidden'                => Schema::TYPE_BOOLEAN . ' DEFAULT FALSE',
            ], $tableOptions
        );

        $this->createTable('{{%bludo_ingredient}}', [
            'id'       => Schema::TYPE_PK, 
            'bludo_id' => Schema::TYPE_INTEGER,
            'ingred_id' => Schema::TYPE_INTEGER
        ], $tableOptions);

        $this->createIndex('FK_bludo', '{{%bludo_ingredient}}', 'bludo_id');
        $this->addForeignKey(
            'FK_bludo_ingred', '{{%bludo_ingredient}}', 'bludo_id', '{{%bludo}}', 'id', 'SET NULL', 'CASCADE'
        );
 
        $this->createIndex('FK_ingred', '{{%bludo_ingredient}}', 'ingred_id');
        $this->addForeignKey(
            'FK_ingred_bludo', '{{%bludo_ingredient}}', 'ingred_id', '{{%ingredient}}', 'id', 'SET NULL', 'CASCADE'
        );
        
    }

    public function down()
    {
        
        $this->dropTable('{{%bludo_ingredient}}');
        $this->dropTable('{{%bludo}}');
        $this->dropTable('{{%ingredient}}');

    }

}
