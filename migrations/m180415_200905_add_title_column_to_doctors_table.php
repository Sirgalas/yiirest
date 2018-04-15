<?php

use yii\db\Migration;
USE app\entities\Doctors;
/**
 * Handles adding title to table `doctors`.
 */
class m180415_200905_add_title_column_to_doctors_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn(Doctors::tableName(),'title',$this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn(Doctors::tableName(),'title');
    }
}
