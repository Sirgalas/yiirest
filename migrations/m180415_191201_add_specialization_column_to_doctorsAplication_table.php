<?php

use yii\db\Migration;
use app\entities\DoctorsAplication;

/**
 * Handles adding specialization to table `doctorsAplication`.
 */
class m180415_191201_add_specialization_column_to_doctorsAplication_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(DoctorsAplication::tableName(),'specialization',$this->boolean());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(DoctorsAplication::tableName(),'specialization');
    }
}
