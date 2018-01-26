<?php

namespace api\modules\v1\controllers;

use common\models\PaymentTransaction;
use api\models\Shop;
use common\models\UserToken;
use Yii;
use api\modules\v1\components\AcShopController;
use api\models\User;
use yii\console\Exception;
use yii\web\BadRequestHttpException;

class UserController extends AcShopController
{
    use \api\modules\v1\traits\Helpers;
    public $modelClass = 'api\models\User';

    public function actionValidation(){
        $request = Yii::$app->request->post('data');
        $userToken=UserToken::findOne(['token'=>$request['token']]);
        if(!$userToken){
            throw new BadRequestHttpException('token is not find');
        }
        $date = new \DateTime("now");
        $datatoken = new \DateTime($userToken->created_at);
        $datatoken->modify('+5 minutes');

        if($date>$datatoken){
            $userToken->delete();
            throw new BadRequestHttpException('token is timeout');
        }
        $userToken->delete();
        return[
            'auth_key'=>$userToken->user->auth_key,
            'password_hash'=>$userToken->user->password_hash,
            'email'=>$userToken->user->email,
            'first_name'=>$userToken->user->first_name,
            'last_name'=>$userToken->user->last_name,
            'phone'=>$userToken->user->phone,
            'ref'=>$userToken->user->ref,
        ];
    }
}