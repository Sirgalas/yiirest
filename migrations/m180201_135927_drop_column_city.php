<?php

use yii\db\Migration;

/**
 * Class m180201_135927_drop_column_city
 */
class m180201_135927_drop_column_city extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->dropColumn('promo','sity_id');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->addColumn('promo','sity_id',$this->integer());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180201_135927_drop_column_city cannot be reverted.\n";

        return false;
    }
    */
}
