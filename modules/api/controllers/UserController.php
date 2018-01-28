<?php

namespace app\modules\api\controllers;


use Yii;
use yii\rest\ActiveController;
use app\modules\api\services\SignupRestServices;
use app\modules\api\services\PasswordResetRestService;


class UserController extends ActiveController
{
    use \app\modules\api\traits\Aplication;

    private $service;
    private $passwordResetService;

    public $modelClass = 'api\entities\User';

    public function __construct($id, $module, SignupRestServices $service,PasswordResetRestService $passwordResetService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
        $this->passwordResetService=$passwordResetService;
    }


    public function actionRegistration(){
        $params = Yii::$app->request->get();
        $user=$this->service->signup($params);
        $this->setHeader(200);
        return ['token' => $user->access_token];
    }



}