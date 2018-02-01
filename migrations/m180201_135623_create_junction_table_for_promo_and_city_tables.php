<?php

use yii\db\Migration;

/**
 * Handles the creation of table `promo_city`.
 * Has foreign keys to the tables:
 *
 * - `promo`
 * - `city`
 */
class m180201_135623_create_junction_table_for_promo_and_city_tables extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('promo_city', [
            'promo_id' => $this->integer(),
            'city_id' => $this->integer(),
            'PRIMARY KEY(promo_id, city_id)',
        ]);

        // creates index for column `promo_id`
        $this->createIndex(
            'idx-promo_city-promo_id',
            'promo_city',
            'promo_id'
        );

        // add foreign key for table `promo`
        $this->addForeignKey(
            'fk-promo_city-promo_id',
            'promo_city',
            'promo_id',
            'promo',
            'id',
            'CASCADE'
        );

        // creates index for column `city_id`
        $this->createIndex(
            'idx-promo_city-city_id',
            'promo_city',
            'city_id'
        );

        // add foreign key for table `city`
        $this->addForeignKey(
            'fk-promo_city-city_id',
            'promo_city',
            'city_id',
            'city',
            'id',
            'CASCADE'
        );

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table `promo`
        $this->dropForeignKey(
            'fk-promo_city-promo_id',
            'promo_city'
        );

        // drops index for column `promo_id`
        $this->dropIndex(
            'idx-promo_city-promo_id',
            'promo_city'
        );

        // drops foreign key for table `city`
        $this->dropForeignKey(
            'fk-promo_city-city_id',
            'promo_city'
        );

        // drops index for column `city_id`
        $this->dropIndex(
            'idx-promo_city-city_id',
            'promo_city'
        );

        $this->dropTable('promo_city');

    }
}
