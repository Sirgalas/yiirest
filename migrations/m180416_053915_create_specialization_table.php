<?php

use yii\db\Migration;
/**
 * Handles the creation of table `specialization`.
 */
class m180416_053915_create_specialization_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('specialization', [
            'id' => $this->primaryKey(),
            'title'=>$this->string(255),
            'coment'=>$this->text()
        ]);
        
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('specialization');
    }
}
