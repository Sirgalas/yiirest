<?php

namespace api\models;

use Yii;

class User extends \common\models\User
{

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token, 'role' => self::ROLE_SHOP]);
    }

}
