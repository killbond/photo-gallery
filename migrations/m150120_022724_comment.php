<?php

use yii\db\Schema;
use yii\db\Migration;

class m150120_022724_comment extends Migration
{
    public function up()
    {
        $this->createTable(
            'comment', [
                'id'            => Schema::TYPE_PK,
                'user_id'       => Schema::TYPE_INTEGER,
                'photo_id'      => Schema::TYPE_INTEGER,
                'username'      => Schema::TYPE_STRING,
                'email'         => Schema::TYPE_STRING,
                'text'          => Schema::TYPE_STRING,
                'rating'        => Schema::TYPE_SMALLINT . ' DEFAULT 1',
                'posted_time'   => Schema::TYPE_TIMESTAMP . ' NOT NULL',
            ]
        );
    }

    public function down()
    {
        $this->dropTable('comment');
        return false;
    }
}
