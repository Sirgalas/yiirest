<?php

use yii\db\Migration;

/**
 * Handles the creation of table `doctors_aplication`.
 * Has foreign keys to the tables:
 *
 * - `doctors`
 * - `aplication`
 */
class m180415_180216_create_junction_table_for_doctors_and_aplication_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
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
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
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
    }
}
