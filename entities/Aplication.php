<?php

namespace app\entities;

use Yii;
use app\entities\DoctorsAplication;

/**
 * This is the model class for table "aplication".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property int $create_at
 * @property int $user_aplication
 * @property int $user_request
 * @property boolean $payment
 * @property int $specialization_id
 * @property int $science_degree_id
 *
 */
class Aplication extends \yii\db\ActiveRecord
{
    const PAYMENT=1;
    const NOTPAYMENT=0;
    
    public static $paymentStatus=[
        self::PAYMENT=>'payment',
        self::NOTPAYMENT=>'not payment'
    ];
    
    public $doctorsTitle;
    public $doctorsSpecialization;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'aplication';
    }

    const SCENARIO_SEARCH = 'Search';

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_SEARCH] = [];
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['create_at', 'user_aplication', 'user_request'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['content'], 'string', 'max' => 610],
            [['payment','specialization_id','science_degree_id'],'integer']
        ];
    }

    public function beforeSave($insert)
    {
        if($insert){
            $this->user_aplication=Yii::$app->user->identity->id;
            $this->create_at=time();
        }

        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'create_at' => 'Create At',
            'user_aplication' => 'User Aplication',
            'user_request' => 'User Request',
            'payment'=>'Payment',
            'specialization_id'=>'Specialization',
            'science_degree_id'=>'Science degree'
        ];
    }

    public function getUser(){
        return $this->hasOne(User::class,['id'=>'user_aplication']);
    }

    public function getComment(){
        return $this->hasMany(CommentAplication::class,['id_aplication'=>'id']);
    }

    public function getScienceDegree(){
        return $this->hasOne(ScienceDegree::className(),['id'=>'science_degree_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public function getSpecialization(){
        return $this->hasOne(Specialization::className(),['id'=>'specialization_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */

    
    public function getStatusPayment(){
        return self::$paymentStatus[$this->payment];
    }
    
    public function getAllPaymentStatus(){
        return self::$paymentStatus;
    }
}
