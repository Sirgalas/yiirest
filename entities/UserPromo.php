<?php

namespace app\entities;

use Yii;

/**
 * This is the model class for table "user_promo".
 *
 * @property int $user_id
 * @property int $promo_id
 *
 * @property Promo $promo
 * @property User $user
 */
class UserPromo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_promo';
    }

    public static function primaryKey()
    {
        return ['user_id', 'user_id'];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'promo_id'], 'required'],
            [['user_id', 'promo_id'], 'integer'],
            [['user_id', 'promo_id'], 'unique', 'targetAttribute' => ['user_id', 'promo_id']],
            [['promo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Promo::className(), 'targetAttribute' => ['promo_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'promo_id' => 'Promo ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromo()
    {
        return $this->hasOne(Promo::className(), ['id' => 'promo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
