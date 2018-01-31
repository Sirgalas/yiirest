<?php

namespace app\entities;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property int $id
 * @property string $name
 * @property string $created_at
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city';
    }

    public static function CityCreate(string  $name): self
    {
        $city = new static();
        $city->name = $name;
        $city->created_at='now()';
        return $city;
    }

    public static function CityUpdate(string  $name): self
    {
        $city = new static();
        $city->name = $name;
        return $city;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at'], 'safe'],
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
            'created_at' => 'Created At',
        ];
    }
    public function getPromo(){
        return $this->hasMany(Promo::className(),['sity_id'=>'id']);
    }
}