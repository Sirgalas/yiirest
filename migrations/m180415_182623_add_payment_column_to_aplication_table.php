<?php

use yii\db\Migration;
use app\entities\Aplication;
/**
 * Handles adding payment to table `aplication`.
 */
class m180415_182623_add_payment_column_to_aplication_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(Aplication::tableName(),'payment',$this->boolean());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(Aplication::tableName(),'payment');
    }
}
