<?php

use yii\db\Migration;

class m220404_050654_create_article_table extends Migration
{

    public function safeUp()
    {
        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'description' => $this->text(),
            'content' => $this->text(),
            'date'=>$this->date(),
            'image'=>$this->string(),
            'viewed'=>$this->integer(),
            'user_id'=>$this->integer(),
            'status'=>$this->integer(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('article');
    }
}
