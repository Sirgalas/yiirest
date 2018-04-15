<?php

use yii\db\Migration;
use app\entities\User;
/**
 * Class m180128_161922_add_access_token_user_table
 */
class m180128_161922_add_access_token_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn(User::tableName(), 'access_token', $this->string(10));
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn(User::tableName(), 'access_token');
    }

}
