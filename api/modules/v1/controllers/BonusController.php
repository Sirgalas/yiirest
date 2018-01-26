<?php

namespace api\modules\v1\controllers;

use common\models\PaymentTransaction;
use api\models\Shop;
use Yii;
use api\modules\v1\components\AcShopController;
use api\models\User;
use yii\console\Exception;
use yii\web\BadRequestHttpException;

class BonusController extends AcShopController
{
    use \common\traits\Bonus;
    use \api\modules\v1\traits\Helpers;
    public $modelClass = 'api\models\User';

    public function actionBonus(){
        $request = Yii::$app->request->post('data');
        $user=User::findOne(['ref'=>$request['ref']]);
        return [
            'bonus'=>$user->user_bonus*Yii::$app->params['bonusCU'],
            'CU'=>Yii::$app->params['bonusCU'],
            'bonusPoints'=>$user->user_bonus
        ];
    }
    public function actionTransaction()
    {
        $request = Yii::$app->request->post('data');
        $user = User::findOne(['ref' => $request['ref']]);
        if (!$user) {
            throw new BadRequestHttpException('Incorrect user');
        }
        $paymentTransaction = PaymentTransaction::findOne(['order_number' => $request['orderNumber']]);
        if ($paymentTransaction) {
            throw new BadRequestHttpException('Order is exist');
        }
        $shop = Shop::findOne(['api_key' => $request['apiKey']]);
        if(!$shop){
            throw new BadRequestHttpException('Incorrect shop');
        }
        if(($user->user_bonus - $request['sum'])<0){
            throw new BadRequestHttpException('Incorrect sum bonus');
        }
        $paymentTransactionCerate = new PaymentTransaction([
            'user_id' => $user->id,
            'name' => 1,
            'status' => 1,
            'sum' => $request['sum'],
            'partner_id' => $shop->id,
            'order_number'=>$request['orderNumber']
        ]);
        try {
            if ($paymentTransactionCerate->save()) {
                $user_bonus = round($user->user_bonus - $request['sum'],5);
                if(!Yii::$app->db->createCommand()->update('"user"',['user_bonus'=>$user_bonus],['id'=>$user->id])->execute()){
                    return var_dump($user->getErrors());
                }
            } else {
                throw new BadRequestHttpException('Error data' . json_encode($paymentTransactionCerate->errors));
            }
        }catch(\Exception $ex){;
            throw new BadRequestHttpException($ex->getMessage());
        }
        $this->setHeader(200);
        return array('status' => 'ok');


    }
}