<?php

use yii\db\Migration;

/**
 * Class m180125_194936_add_column_status__user_table
 */
class m180125_194936_add_column_status__user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('user','status',$this->integer());
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('user','status');
    }

}
