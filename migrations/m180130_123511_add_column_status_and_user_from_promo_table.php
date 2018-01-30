<?php

use yii\db\Migration;

/**
 * Class m180130_123511_add_column_status_and_user_from_promo_table
 */
class m180130_123511_add_column_status_and_user_from_promo_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('promo','status',$this->integer());
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
       $this->dropColumn('promo','status');
    }


}
