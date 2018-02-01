<?php

use yii\db\Migration;

/**
 * Class m180125_181235_table_user
 */
class m180125_181235_table_user extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('user',[
            'id'=>$this->primaryKey(),
            'username'=>$this->string(255),
            'email'=>$this->string(255),
            'password_hash'=>$this->string(60),
            'auth_key'=>$this->string(32),
            'confirmed_at'=>$this->integer(),
            'unconfirmed_email'=>$this->string(255),
            'blocked_at'=>$this->integer(),
            'registration_ip'=>$this->string(45),
            'created_at'=>$this->timestamp(),
            'updated_at'=>$this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'flags'=>$this->integer(),
            'last_login_at'=>$this->integer(),
            'status'=>$this->integer(),
            'access_token'=>$this->string(6)
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }

}
