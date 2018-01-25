<?php

use yii\db\Migration;

/**
 * Handles the creation of table `aplication`.
 */
class m180125_183003_create_aplication_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('aplication', [
            'id' => $this->primaryKey(),
            'title'=>$this->string(255)->notNull(),
            'content'=>$this->string(610),
            'create_at'=>$this->integer(),
            'user_aplication'=>$this->integer()->notNull(),
            'user_request'=>$this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('aplication');
    }
}
