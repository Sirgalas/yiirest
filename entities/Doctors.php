<?php

namespace app\entities;

use Yii;

/**
 * This is the model class for table "doctors".
 *
 * @property int $id
 * @property string $name
 * @property string $specialization
 *
 * @property DoctorsAplication[] $doctorsAplications
 * @property Aplication[] $aplications
 */
class Doctors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'doctors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'specialization'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'specialization' => 'Specialization',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoctorsAplications()
    {
        return $this->hasMany(DoctorsAplication::className(), ['doctors_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAplications()
    {
        return $this->hasMany(Aplication::className(), ['id' => 'aplication_id'])->viaTable('doctors_aplication', ['doctors_id' => 'id']);
    }
}
