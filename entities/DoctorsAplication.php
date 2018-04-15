<?php

namespace app\entities;

use Yii;

/**
 * This is the model class for table "doctors_aplication".
 *
 * @property int $doctors_id
 * @property int $aplication_id
 * @property int $specialization
 * @property Aplication $aplication
 * @property Doctors $doctors
 */
class DoctorsAplication extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'doctors_aplication';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['doctors_id', 'aplication_id'], 'required'],
            [['doctors_id', 'aplication_id','specialization'], 'integer'],
            [['doctors_id', 'aplication_id'], 'unique', 'targetAttribute' => ['doctors_id', 'aplication_id']],
            [['aplication_id'], 'exist', 'skipOnError' => true, 'targetClass' => Aplication::class, 'targetAttribute' => ['aplication_id' => 'id']],
            [['doctors_id'], 'exist', 'skipOnError' => true, 'targetClass' => Doctors::class, 'targetAttribute' => ['doctors_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'doctors_id' => 'Doctors ID',
            'aplication_id' => 'Aplication ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAplication()
    {
        return $this->hasOne(Aplication::class, ['id' => 'aplication_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoctors()
    {
        return $this->hasOne(Doctors::class, ['id' => 'doctors_id']);
    }
}
