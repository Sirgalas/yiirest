<?php

namespace api\modules\v1\controllers;

use common\models\Shop;
use common\models\ShopApp;
use Yii;
use api\modules\v1\components\AcShopController;
use api\models\OrderExternal;
use yii\web\BadRequestHttpException;
use api\models\User;
use common\models\UserBonusPercent;
use common\models\UserBonusItem;
use yii\web\NotFoundHttpException;

/**
 * Order Controller API
 *
 */
class OrderController extends AcShopController
{

    use \api\modules\v1\traits\Helpers;
    use \common\traits\Bonus;

    public $modelClass = 'common\models\OrderExternal';

    /**
     * Добавления нового сайта
     * @return type
     */
    public function actionCreate()
    {
        $shop = Yii::$app->params['shop'];
        $request = Yii::$app->params['request'];

        if (OrderExternal::findOne(['shop_id' => $shop->id, 'external_id' => $request['order'],'updated_at'=>'now()'])) {
            throw new BadRequestHttpException('Order is exist');
        }
        //$shop = Shop::findOne($shop->id);
        /*if(!$shop){
            throw new BadRequestHttpException('incorrect shop');
        }*/
        $user = User::findOne(['ref' => $request['code']]);
        if (!$user) {
            throw new BadRequestHttpException('Incorrect code:'.$request['code']);
        }

        if(isset($request['shop_app_id']) && !empty($request['shop_app_id'])){
            $shopApp = ShopApp::findOne($request['shop_app_id']);
            if(!$shopApp){
                throw new NotFoundHttpException("Ошибка инициализации магазина");
            }
        }else{
            $request["shop_app_id"]=null;
        }
        $order = new OrderExternal([
            'user_id' => $user->id,
            'shop_id' => $shop->id,
            'external_id' => (string)$request['order'],
            'amount' => $request['amount'],
            'comment' => $request['comment'],
            'shop_app_id' => $request['shop_app_id']
        ]);
        $transaction = Yii::$app->db->beginTransaction();
        try {
            if (!$order->save()) {
                Yii::error($request);
                throw new BadRequestHttpException('Error data' . json_encode($order->errors));
            }
            $this->calculationBonus($user,$shop->bonus_coef,$order->amount);
        }catch(\Exception $ex){
            $transaction->rollBack();
            throw new BadRequestHttpException($ex->getMessage());
        }
        $transaction->commit();
        $this->setHeader(200);
        return array('status' => 'ok');
    }

    public function actionGetFio(){
        $shop = Yii::$app->params['shop'];
        $request = Yii::$app->params['request'];
        $user = User::findOne(['ref' => $request['code']]);
        if(!$user){
            throw new BadRequestHttpException('Incorrect code:'.$request['code']);
        }else{
            return ['fio'=>$user->getFullName()];
        }
    }

    public function actionGetList(){
        $shop = Yii::$app->params['shop'];
        $request = Yii::$app->params['request'];
        $shopApp = ShopApp::findOne($request['shop_app_id']);
        if(!$shopApp){
            throw new NotFoundHttpException("Ошибка, ваше приложение деактивировано");
        }
        $dateFrom = Yii::$app->formatter->asDate($request['date_from']." 00:00:00" ,"php:Y-m-d H:i:s e");
        $dateTo = Yii::$app->formatter->asDate($request['date_to']." 23.59.59", "php:Y-m-d H:i:s e");
        $orders = OrderExternal::find()->where(["shop_app_id"=>$shopApp->id])->andWhere("created_at between '$dateFrom' and '$dateTo'")->all();
        return ["orders"=>$orders];
    }
}
