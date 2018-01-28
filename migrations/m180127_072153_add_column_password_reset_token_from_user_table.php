<?php

use yii\db\Migration;

/**
 * Class m180127_072153_add_column_password_reset_token_from_user_table
 */
class m180127_072153_add_column_password_reset_token_from_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('user','password_reset_token',$this->string(255));

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
       $this->dropColumn('user','password_reset_token',$this->string(255));
    }
}
