<?php

use yii\db\Migration;

/**
 * Class m180127_122212_add_column_update_at_from_comment_aplication_table
 */
class m180127_122212_add_column_update_at_from_comment_aplication_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('comment_aplication','updated_at',$this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'));
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('comment_aplication','updated_at');
    }


}
