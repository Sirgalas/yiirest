<?php

use yii\db\Migration;

/**
 * Class m180201_113323_add_collumn_remuneration_from_prome_column
 */
class m180201_113323_add_collumn_remuneration_from_prome_column extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('promo','remuneration',$this->integer());

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('promo','remuneration');
    }

}
