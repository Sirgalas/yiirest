<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 28.01.18
 * Time: 20:29
 */

namespace app\modules\api\services;

use app\modules\api\entities\User;
use yii\web\BadRequestHttpException;

class LoginRestService
{
    public function auth($token){
        $user=(new User())->findIdentityByAccessToken($token);
        if(!$user)
            throw new BadRequestHttpException('User not find');
        return $user;
    }

}