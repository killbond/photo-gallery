<?php

use yii\db\Schema;
use yii\db\Migration;

class m150118_225452_photo extends Migration
{
    public function up()
    {
        $this->createTable(
            'photo', [
                'id'            => Schema::TYPE_PK,
                'user_id'       => Schema::TYPE_INTEGER,
                'file_location' => Schema::TYPE_STRING,
                'description'   => Schema::TYPE_STRING,
                'uploaded_time' => Schema::TYPE_TIMESTAMP . ' NOT NULL',
            ]
        );
    }

    public function down()
    {
        $this->dropTable('photo');
        return false;
    }
}
