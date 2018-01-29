<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 25.01.18
 * Time: 22:13
 */

namespace app\services;

use app\entities\User;
use app\forms\SignupForm;

class SignupFormService
{
    public function signup($form)
    {
        if(User::find()->andWhere(['username'=>$form->username])->one()){
            throw new \DomainException('Username is already exist');
        }
        if(User::find()->andWhere(['email'=>$form->username])->one()){
            throw new \DomainException('Email is already exist');
        }

        $user = User::signup(
            $form->username,
            $form->email,
            $form->password
        );

        if (!$user->save()) {
            throw new \RuntimeException('Saving Error');
        }

        return $user;

    }
}