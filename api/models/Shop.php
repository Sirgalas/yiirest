<?php

namespace api\models;

class Shop extends \common\models\Shop
{

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['auth_key' => $token, 'type' => self::TYPE_EXTERNAL]);
    }

}
