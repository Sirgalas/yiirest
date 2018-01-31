<?php


namespace app\services;


use app\entities\Promo;
use app\forms\PromoForm;
use JsonSchema\Exception\RuntimeException;

class PromoFormServices
{
    public function create(PromoForm $form){
        if(Promo::find()->where(['name'=>$form->name]))
            throw new RuntimeException('this promo already exist');
        $promo=Promo::PromoSaves(
            $form->date_start,
            $form->date_finish,
            $form->sity_id,
            $form->status,
            $form->name
        );
        if(!$promo->save())
            throw new RuntimeException('Promo not save');
        return $promo;
    }

}