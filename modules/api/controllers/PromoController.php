<?php
namespace app\modules\api\controllers;
use app\entities\Promo;
use app\entities\PromoCity;
use Yii;
use yii\rest\ActiveController;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

class PromoController extends ActiveController
{
    public $modelClass = 'app\entities\Promo';

    use \app\modules\api\traits\Aplication;



    public function actionGetPromo(){
        $get= Yii::$app->request->get();
        $promo=Promo::findOne(['name'=>$get['name']]);
        if(!$promo)
            throw new NotFoundHttpException('error request',404 );
        if(!empty($get['field'])){
            foreach ($get['field'] as $field){
                $fields[$field]=$promo->$field;
            }
        }else{
            $fields=$promo;
        }
        try{
            $this->setHeader(200);
            return $fields;
        }catch (NotFoundHttpException $ex){
            $this->setHeader($ex->getCode());
            return $ex->getMessage();
        }

    }

    public function actionSetPromo(){
        $get=Yii::$app->request->get();
        if(!isset($get['promo'])||!isset($get['city']))
            throw new NotFoundHttpException('error request',400);
        $sql="SELECT * FROM promo INNER JOIN promo_city ON promo_id=id WHERE name='".$get['promo']."' AND city_id=(SELECT id FROM city WHERE name='".$get['city']."')";
        $promo=Promo::findBySql($sql)->one();
        if(!$promo)
            throw new NotFoundHttpException('result not found',404);
        try{
            $this->setHeader(200);
            return array('sum'=>$promo->remuneration);
        }catch (NotFoundHttpException $ex){
            $this->setHeader($ex->getCode());
            return $ex->getMessage();
        }
    }

}