<?php

namespace app\modules\api\controllers;


use Yii;
use yii\rest\ActiveController;
use app\modules\api\services\SignupRestServices;
use app\modules\api\services\PasswordResetRestService;


class UserController extends ActiveController
{
    use \app\modules\api\traits\Aplication;


    public $modelClass = 'api\entities\User';

    public function actionRegistration(){
        $service=new SignupRestServices();
        $params = Yii::$app->request->get();
        $user=$service->signup($params);
        $this->setHeader(200);
        return ['token' => $user->access_token,'id'=>$user->id];
    }



}