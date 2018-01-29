<?php

use yii\db\Migration;

/**
 * Handles the creation of table `city`.
 */
class m180129_210635_create_city_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('city', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(255),
            'created_at'=>$this->timestamp(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('city');
    }
}
