<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 27.01.18
 * Time: 21:48
 */

namespace app\modules\api\services;

use app\modules\api\entities\User;

class SignupRestServices
{
    public function signup( $get): User
    {

        if(User::find()->andWhere(['username'=>$get['username']])->one()){
            throw new \DomainException('Username is already exist');
        }
        if(User::find()->andWhere(['email'=>$get['username']])->one()){
            throw new \DomainException('Email is already exist');
        }

        $user = User::signup(
            $get['username'],
            $get['email'],
            $get['password']
        );

        if (!$user->save()) {
            throw new \RuntimeException('Error data' . json_encode($user->errors));
        }

        return $user;

    }
}