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
            'date_start'=>$this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'date_finish'=>$this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'sity_id'=>$this->integer(),
            'status'=>$this->integer(2)
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
