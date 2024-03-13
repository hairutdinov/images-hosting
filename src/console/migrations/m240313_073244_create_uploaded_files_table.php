<?php

use yii\db\Migration;

class m240313_073244_create_uploaded_files_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%uploaded_files}}', [
            'id' => $this->primaryKey(),
            'filename' => $this->string()->notNull(),
            'uploaded_at' => $this->datetime()->notNull(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%uploaded_files}}');
    }
}
