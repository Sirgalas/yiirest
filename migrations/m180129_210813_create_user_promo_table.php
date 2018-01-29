<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_promo`.
 */
class m180129_210813_create_user_promo_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user_promo', [
            'id' => $this->primaryKey(),
            'id_user'=>$this->integer(),
            'id_promo'=>$this->integer()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user_promo');
    }
}
