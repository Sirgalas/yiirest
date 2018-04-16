<?php

use yii\db\Migration;
use app\entities\Doctors;
use app\entities\Aplication;
/**
 * Class m180416_043817_refactor_more_table
 */
class m180416_043817_refactor_more_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        // drops foreign key for table `doctors`
        $this->dropForeignKey(
            'fk-doctors_aplication-doctors_id',
            'doctors_aplication'
        );

        // drops index for column `doctors_id`
        $this->dropIndex(
            'idx-doctors_aplication-doctors_id',
            'doctors_aplication'
        );

        // drops foreign key for table `aplication`
        $this->dropForeignKey(
            'fk-doctors_aplication-aplication_id',
            'doctors_aplication'
        );

        // drops index for column `aplication_id`
        $this->dropIndex(
            'idx-doctors_aplication-aplication_id',
            'doctors_aplication'
        );

        $this->dropTable('{{%doctors_aplication}}');
        $this->dropColumn(Doctors::tableName(),'title');
        $this->addColumn(Doctors::tableName(),'specialization_id',$this->integer());
        $this->addColumn(Doctors::tableName(),'science_degree_id',$this->integer());
        $this->addColumn(Aplication::tableName(),'specialization_id',$this->integer());
        $this->addColumn(Aplication::tableName(),'science_degree_id',$this->integer());
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->addColumn(Doctors::tableName(), 'title', $this->string());


        $this->createTable('{{%doctors_aplication}}', [
            'doctors_id' => $this->integer(),
            'aplication_id' => $this->integer(),
            'PRIMARY KEY(doctors_id, aplication_id)',
        ]);

        // creates index for column `doctors_id`
        $this->createIndex(
            'idx-doctors_aplication-doctors_id',
            'doctors_aplication',
            'doctors_id'
        );

        // add foreign key for table `doctors`
        $this->addForeignKey(
            'fk-doctors_aplication-doctors_id',
            'doctors_aplication',
            'doctors_id',
            'doctors',
            'id',
            'CASCADE'
        );

        // creates index for column `aplication_id`
        $this->createIndex(
            'idx-doctors_aplication-aplication_id',
            'doctors_aplication',
            'aplication_id'
        );

        // add foreign key for table `aplication`
        $this->addForeignKey(
            'fk-doctors_aplication-aplication_id',
            'doctors_aplication',
            'aplication_id',
            'aplication',
            'id',
            'CASCADE'
        );

        $this->addColumn(Doctors::tableName(),'specialization',$this->string());
        $this->dropColumn(Doctors::tableName(),'specialization_id');
        $this->dropColumn(Doctors::tableName(),'science_degree_id');
        $this->dropColumn(Aplication::tableName(),'specialization_id');
        $this->dropColumn(Aplication::tableName(),'science_degree_id');
    }
}
