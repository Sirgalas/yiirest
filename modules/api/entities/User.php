<?php

namespace app\modules\api\entities;

use Yii;

class User extends \app\entities\User
{

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

}
