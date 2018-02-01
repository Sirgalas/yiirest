<?php


namespace app\services;


use app\entities\Promo;
use app\forms\PromoForm;

class PromoFormServices
{
    public function create(PromoForm $form){
        if(Promo::find()->where(['name'=>$form->name])->one())
            throw new \RuntimeException('this promo already exist');
        $promo=Promo::PromoSaves(
            $form->date_start,
            $form->date_finish,
            $form->sity_id,
            $form->status,
            $form->name,
            $form->remuneration
        );
        if(!$promo->save())
            throw new \RuntimeException('Promo not save');
        return $promo;
    }

}