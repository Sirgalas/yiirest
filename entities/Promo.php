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
 * @property array $city_id
 * @property int $user_id
 * @property int $status
 * @property int $remuneration
 */
class Promo extends \yii\db\ActiveRecord
{
    public $user_id;
    public $city_id;
    /**
     * @inheritdoc
     */
    const  STATUS_YES=1;
    const STATUS_NO=0;

    public static $statusArr=[
        self::STATUS_NO=>'Not Active',
        self::STATUS_YES=>'Active',
    ];

    public static function tableName()
    {
        return 'promo';
    }

    public static function PromoSaves( $date_start, $date_finish, $sity_id,int $status,string $name, int $remuneration){
        $promo = new static();
        $promo->date_start=$date_start;
        $promo->date_finish=$date_finish;
        $promo->city_id=$sity_id;
        $promo->status=$status;
        $promo->name=$name;
        $promo->remuneration=$remuneration;
        return $promo;
    }
    public function PromoEdit( $date_start, $date_finish, $sity_id,int $status,string $name, int $remuneration): void
    {

        $this->date_start = $date_start;
        $this->date_finish = $date_finish;
        $this->city_id = $sity_id;
        $this->status = $status;
        $this->name = $name;
        $this->remuneration = $remuneration;
    }

    public function afterSave($insert, $changedAttributes)
    {
        if(PromoCity::find()->where(['promo_id'=>$this->id])->andFilterWhere(['in','city_id',$this->city_id])->one()){
            $city = new City();
            $this->link('city',$city);
        }else{
            foreach ($this->city_id as $city_id){
                $city = new PromoCity([
                    'promo_id'=>$this->id,
                    'city_id'=>$city_id
                ]);
                if(!$city->save()){
                    return var_dump($city->getErrors());
                }
            }
        }
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status','remuneration'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['date_start', 'date_finish'], 'safe']
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
            'remuneration'=> 'Remuneration'
        ];
    }

    public function getCity(){
        return $this->hasMany(City::className(), ['id' => 'city_id'])->viaTable('{{%promo_city}}', ['promo_id' => 'id']);

    }
    public function getUser(){
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('{{%user_promo}}', ['promo_id' => 'id']);
    }
}
