<?php

use yii\db\Migration;

/**
 * Handles the creation of table `doctors`.
 */
class m180415_174952_create_doctors_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%doctors}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(255),
            'specialization'=>$this->string(255),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%doctors}}');
    }
}
