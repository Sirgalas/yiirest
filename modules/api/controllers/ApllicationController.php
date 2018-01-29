<?php

namespace app\modules\api\controllers;


use Yii;

use app\modules\api\entities\User;
use yii\web\BadRequestHttpException;
use yii\rest\ActiveController;
use app\entities\Aplication;
use app\modules\api\services\LoginRestService;
use app\modules\api\services\SearchRestService;
class ApllicationController extends ActiveController
{

    public $modelClass = 'app\entities\Aplication';

    use \app\modules\api\traits\Aplication;

    private $serviceLogin;
    private $serviceSearch;

    public function __construct($id, $module,  $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->serviceLogin = new LoginRestService();
        $this->serviceSearch = new SearchRestService();
    }

    public function actionAdd(){
        $params=Yii::$app->request->get();
        if(!isset($params['token']))
            throw new BadRequestHttpException('get params token must be blank');
        $user=$this->serviceLogin->auth($params['token']);
        Yii::$app->user->login($user);
        $application= new Aplication([
            'title'=>$params['title'],
            'content'=>$params['content']
        ]);
        try{
            if(!$application->save())
                throw new BadRequestHttpException('Error data' . json_encode($application->errors));

            $this->setHeader(200);
            return array('request' => 'Application saved by id '.$application->id);
        }catch (BadRequestHttpException $ex){
            throw new BadRequestHttpException($ex->getMessage());
        }
    }
    public function actionSearch(){
        $params=Yii::$app->request->get();
        $apllication=$this->serviceSearch->search($params);
        $this->setHeader(200);
        return $apllication;

    }
}