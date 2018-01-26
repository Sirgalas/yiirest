<?php

namespace api\modules\v1\controllers;

use api\models\ShopApp;
use api\modules\v1\components\AcShopAppController;
use common\models\PaymentTransaction;
use api\models\Shop;
use Yii;
use api\models\User;
use yii\console\Exception;
use yii\web\BadRequestHttpException;

class ShopAppController extends AcShopAppController
{
    use \common\traits\Bonus;
    use \api\modules\v1\traits\Helpers;
    public $modelClass = 'api\models\ShopApp';

    public function actionRegisterNewApp(){
        /**
         * @var $shopApp ShopApp
         */
        $shopApp = Yii::$app->params['shopApp'];
        $request = Yii::$app->params['request'];
        if(!$shopApp->shop){
            throw new BadRequestHttpException('Данный магазин не активен');
        }
        $shopApp->code = null;
        $shopApp->first_name = $request['surname'];
        $shopApp->last_name = $request['name'];
        $shopApp->patronymic = $request['patronymic'];
        $shopApp->description = $request['desc'];
        $shopApp->active = true;

        if($shopApp->save()){
            return ['id'=>$shopApp->id,'shopPVK'=>$shopApp->shop->auth_key];
        }else{
            throw new BadRequestHttpException(implode(";",$shopApp->getErrors()));
        }
    }
}