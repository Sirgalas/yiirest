<?php
namespace app\modules\api\controllers;
use app\entities\Promo;
use Yii;
use yii\rest\ActiveController;
use yii\web\BadRequestHttpException;

class PromoController extends ActiveController
{
    public $modelClass = 'app\entities\Promo';

    use \app\modules\api\traits\Aplication;



    public function actionGetPromo(){
        $get= Yii::$app->request->get();
        $promo=Promo::findOne(['name'=>$get['name']]);
        if(!empty($get['field'])){
            foreach ($get['field'] as $field){
                $fields[$field]=$promo->$field;
            }
        }else{
            $fields=$promo;
        }
        if(!$promo){
            $this->setHeader(404);
            return array('request'=>'Promo '.$get['name'].' not find');
        }
        $this->setHeader(200);
        return $fields;
    }

    public function actionSetPromo(){
        $get=Yii::$app->request->get();

    }

}