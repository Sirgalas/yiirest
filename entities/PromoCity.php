<?php

namespace app\entities;

use Yii;

/**
 * This is the model class for table "promo_city".
 *
 * @property int $promo_id
 * @property int $city_id
 *
 * @property City $city
 * @property Promo $promo
 */
class PromoCity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'promo_city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['promo_id', 'city_id'], 'required'],
            [['promo_id', 'city_id'], 'integer'],
            [['promo_id', 'city_id'], 'unique', 'targetAttribute' => ['promo_id', 'city_id']],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
            [['promo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Promo::className(), 'targetAttribute' => ['promo_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'promo_id' => 'Promo ID',
            'city_id' => 'City ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromo()
    {
        return $this->hasOne(Promo::className(), ['id' => 'promo_id']);
    }
}
