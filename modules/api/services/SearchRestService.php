<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 28.01.18
 * Time: 21:30
 */

namespace app\modules\api\services;

use app\entities\Aplication;
use app\modules\api\entities\User;
use yii\web\BadRequestHttpException;

class SearchRestService
{
    public function searchById($id){
        $application=Aplication::findOne($id);
        if(!$application)
            return false;
        return $application;
    }

    public function  searchByUser($id){
        $application=Aplication::find()->where(['user_aplication'=>$id])->all();
        if(!$application)
            return 'Aplication not find';
        return $application;
    }

    public function search($params){

        if(isset($params['id'])){
            $entities=$this->searchById($params['id']);
            if($entities)
                $result=array('title'=>$entities->title,'content'=>$entities->content,'create_applecation'=>$entities->create_at,'user_create_aplication'=>$entities->user->username);
        }
        if(isset($params['user_id'])){
            $user=User::findOne($params['user_id']);
            if(!$user)
                throw new BadRequestHttpException('User not find');
            $entities=$this->searchByUser($params['user_id']);
            if($entities){
                foreach ($entities as $oneEntities){
                    $result[]=array('title'=>$oneEntities->title,'content'=>$oneEntities->content,'create_applecation'=>$oneEntities->create_at,'user_create_aplication'=>$oneEntities->user->username);
                }
            }
        }
        if(!empty($result))
            return $result;
        return array('result'=>'aplication not find');
    }

}