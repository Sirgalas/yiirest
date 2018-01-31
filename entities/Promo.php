<?php

namespace app\entities;

use Yii;

/**
 * This is the model class for table "promo".
 *
 * @property int $id
 * @property string $name
 * @property int $date_start
 * @property int $date_finish
 * @property int $sity_id
 * @property int $user_id
 * @property int $status
 */
class Promo extends \yii\db\ActiveRecord
{
    public $user_id;
    /**
     * @inheritdoc
     */
    const  STATUS_YES=1;
    const STATUS_NO=0;
    private $status=[
        self::STATUS_NO=>'No',
        self::STATUS_YES=>'Yes',
    ];
    public static function tableName()
    {
        return 'promo';
    }

    public static function PromoSaves(int $date_start,int $date_finish,int $sity_id,int $status,string $name){
        $promo = new static();
        $promo->date_start=$date_start;
        $promo->date_finish=$date_finish;
        $promo->sity_id=$sity_id;
        $promo->status=$status;
        $promo->name=$name;
        return $promo;
    }




    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_start', 'date_finish', 'sity_id','staus'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            'date_start' => 'Date Start',
            'date_finish' => 'Date Finish',
            'sity_id' => 'Sity ID',
        ];
    }

    public function getCity(){
        return $this->hasOne(City::className(),['id'=>'sity_id']);
    }
    public function getUser(){
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('{{%user_promo}}', ['promo_id' => 'id']);

    }
}
