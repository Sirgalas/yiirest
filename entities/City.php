<?php

namespace app\entities;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
/**
 * This is the model class for table "city".
 *
 * @property int $id
 * @property string $name
 * @property string $created_at
 */
class City extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => false,
                'value' => new Expression('NOW()'),
            ],
        ];
    }
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
        return $city;
    }

    public function CityUpdate(string  $name)
    {
        $this->name = $name;
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
        return $this->hasMany(Promo::className(), ['id' => 'promo_id'])->viaTable('{{%promo_city}}', ['city_id' => 'id']);
    }

}
