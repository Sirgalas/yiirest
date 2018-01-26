<?php

use yii\db\Migration;

/**
 * Handles the creation of table `comemt_aplication`.
 */
class m180126_120813_create_comemt_aplication_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('comment_aplication', [
            'id' => $this->primaryKey(),
            'user_id'=>$this->integer()->notNull(),
            'id_aplication'=>$this->integer()->notNull(),
            'title'=>$this->string(255),
            'comment'=>$this->string(610),
            'create_at'=>$this->timestamp(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('comment_aplication');
    }
}
