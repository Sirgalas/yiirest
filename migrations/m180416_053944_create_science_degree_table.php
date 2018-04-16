<?php

use yii\db\Migration;

/**
 * Handles the creation of table `science_degree`.
 */
class m180416_053944_create_science_degree_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('science_degree', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(),
            'comment'=>$this->text()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('science_degree');
    }
}
