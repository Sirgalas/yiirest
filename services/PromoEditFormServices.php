<?php


namespace app\services;


use app\entities\Promo;
use app\forms\EditPromoForm;

class PromoEditFormServices
{
    public function create(EditPromoForm $form){
        if(!Promo::find()->where(['name'=>$form->name])->one())
            throw new \RuntimeException('this promo not find');
        $promo=Promo::PromoSaves(
            $form->date_start,
            $form->date_finish,
            $form->sity_id,
            $form->status,
            $form->name
        );
        if(!$promo->save())
            throw new \RuntimeException('Promo not save');
        return $promo;
    }

}