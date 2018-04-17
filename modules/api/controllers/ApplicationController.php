<?php

namespace app\modules\api\controllers;


use Yii;

use app\modules\api\entities\User;
use yii\web\BadRequestHttpException;
use yii\rest\ActiveController;
use app\entities\Aplication;
use app\modules\api\services\LoginRestService;
use app\modules\api\services\SearchRestService;

class ApplicationController extends ActiveController
{

    public $modelClass = 'app\entities\Aplication';

    use \app\modules\api\traits\Aplication;

    private $serviceLogin;
    private $serviceSearch;

    public function __construct($id, $module, LoginRestService $serviceLogin, SearchRestService $serviceSearch, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->serviceLogin = $serviceLogin;
        $this->serviceSearch = $serviceSearch;
    }

    public function actionAdd(){
        $params=Yii::$app->request->get();
        if($params['lang'])
            Yii::$app->language=$params['lang'];
        if(!isset($params['token']))
            throw new BadRequestHttpException(Yii::t('error','Token'));
        $user=$this->serviceLogin->auth($params['token']);
        if(!Yii::$app->user->login($user))
            throw new \Exception(Yii::t('error','User'));
        $application= new Aplication([
            'title'=>$params['title'],
            'content'=>$params['content'],
            'specialization_id'=>$params['specialization_id']?$params['specialization_id']:null,
            'science_degree_id'=>$params['science_degree_id']?$params['science_degree_id']:null,
        ]);
        try{
            if(!$application->save())
                throw new BadRequestHttpException(Yii::t('error','Error data') . print_r($application->getErrors(), 1));

            $this->setHeader(200);
            return array('request' => Yii::t('error','Application_saved').$application->id);
        }catch (BadRequestHttpException $ex){
            throw new BadRequestHttpException($ex->getMessage());
        }
    }
    public function actionSpecialization(){
        $params=Yii::$app->request->get();
        if($params['lang'])
            Yii::$app->language=$params['lang'];
        if(!isset($params['token']))
            throw new BadRequestHttpException(Yii::t('error','Token'));
        $user=$this->serviceLogin->auth($params['token']);
        if(!Yii::$app->user->login($user))
            throw new \Exception(Yii::t('error','User'));
        unset($params['token']);
        unset($params['lang']);
        $params['user_aplication']=$user->id;
        $application=Aplication::find()->where($params)->all();
        $this->setHeader(200);
        return $application;

    }
    
}