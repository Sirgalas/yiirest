<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 30.01.18
 * Time: 16:26
 */

namespace app\services;

use app\entities\City;
use app\forms\CityForm;
use app\forms\CityEditForm;

class CityFormService
{
    public function create(CityForm $form){
        if(City::find()->where(['name'=>$form->name])->one())
            throw new \RuntimeException('this city already exist');
        $city= City::CityCreate(
            $form->name
        );
        if(!$city->save())
            throw new \RuntimeException('City not save');
        return $city;
    }
    public function update(CityEditForm $form, City $city){
        if(!City::find()->where(['name'=>$form->name]))
            throw new \RuntimeException('this city not find');
        $city->CityUpdate($form->name);

        if(!$city->save())
            throw new \RuntimeException('City not update');
        return $city;
    }
}