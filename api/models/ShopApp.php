<?php
namespace api\models;

class ShopApp extends \common\models\ShopApp
{

    /**
     * @inheritdoc
     */
    public static function findIdentityByCode($token, $type = null)
    {
        return static::findOne(['code' => $token]);
    }

}