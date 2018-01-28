<?php

namespace app\modules\api\models;

use Yii;

class User extends \app\entities\User
{

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token, 'role' => self::ROLE_SHOP]);
    }

}
