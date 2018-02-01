<?php


namespace app\services;


use app\entities\Promo;
use app\forms\EditPromoForm;
use yii\web\NotFoundHttpException;

class PromoEditFormServices
{
    public function create(Promo $promo,EditPromoForm $form){
        if(!Promo::find()->where(['name'=>$form->name])->one())
            throw new \RuntimeException('this promo not find');
        $promo->PromoEdit(
            $form->date_start,
            $form->date_finish,
            $form->city_id,
            $form->status,
            $form->name,
            $form->remuneration
        );
        if(!$promo->save())
            throw new \RuntimeException('Error data' . json_encode($promo->errors));
        return $promo;
    }

   /* private function get($id): Promo
    {
        if (!$promo = Promo::findOne($id)) {
            throw new \RuntimeException('Promo is not found.');
        }
        return $promo;
    }*/

}