<?php

namespace app\entities;

use Yii;
use app\entities\ScienceDegree;
use app\entities\Specialization;

/**
 * This is the model class for table "doctors".
 *
 * @property int $id
 * @property string $name
 * @property string $specialization
 * @property string $title
 * @property Aplication[] $aplications
 * @property int $specialization_id
 * @property int $science_degree_id
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
            [['name','title', 'specialization'], 'string', 'max' => 255],
            [['specialization_id','science_degree_id'],'integer']
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
            'title' => 'Title',
            'specialization' => 'Specialization',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    
    public function getScienceDegree(){
        return $this->hasOne(ScienceDegree::className(),['id'=>'specialization_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    
    public function getSpecialization(){
        return $this->hasOne(Specialization::className(),['id'=>'specialization_id']);
    }
}
