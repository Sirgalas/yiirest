<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_promo`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `promo`
 */
class m180130_115300_create_junction_table_for_user_and_promo_tables extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user_promo', [
            'user_id' => $this->integer(),
            'promo_id' => $this->integer(),
            'PRIMARY KEY(user_id, promo_id)',
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-user_promo-user_id',
            'user_promo',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-user_promo-user_id',
            'user_promo',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `promo_id`
        $this->createIndex(
            'idx-user_promo-promo_id',
            'user_promo',
            'promo_id'
        );

        // add foreign key for table `promo`
        $this->addForeignKey(
            'fk-user_promo-promo_id',
            'user_promo',
            'promo_id',
            'promo',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-user_promo-user_id',
            'user_promo'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-user_promo-user_id',
            'user_promo'
        );

        // drops foreign key for table `promo`
        $this->dropForeignKey(
            'fk-user_promo-promo_id',
            'user_promo'
        );

        // drops index for column `promo_id`
        $this->dropIndex(
            'idx-user_promo-promo_id',
            'user_promo'
        );

        $this->dropTable('user_promo');
    }
}
