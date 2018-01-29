<?php

use yii\db\Migration;

/**
 * Handles the creation of table `promo`.
 */
class m180129_210537_create_promo_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('promo', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(255),
            'date_start'=>$this->integer(),
            'date_finish'=>$this->integer(),
            'sity_id'=>$this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('promo');
    }
}
