<?php

namespace app\modules\api\controllers;


use Yii;
use yii\rest\ActiveController;
use app\modules\api\models\User;
use app\modules\api\services\SignupRestServices;
use app\modules\api\services\PasswordResetRestService;
use yii\console\Exception;
use yii\web\BadRequestHttpException;

class UserController extends ActiveController
{
    //use \app\modules\api\traits\Aplication;

    private $service;
    private $passwordResetService;

    public $modelClass = 'api\models\User';

    public function __construct($id, $module, SignupRestServices $service,PasswordResetRestService $passwordResetService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
        $this->passwordResetService=$passwordResetService;
    }


    public function actionRegistration(){
        $params = Yii::$app->request->get();
        $this->service->signup($params);
    }

    public function actionLogin(){

    }

    public function actionRequestPasswordReset(){

    }

    public function actionResetPassword(){

    }

}