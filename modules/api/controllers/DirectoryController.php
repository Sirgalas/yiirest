<?php

namespace app\modules\api\controllers;


use app\entities\Doctors;
use app\entities\ScienceDegree;
use app\entities\Specialization;
use Yii;

use app\modules\api\entities\User;
use yii\web\BadRequestHttpException;
use yii\rest\ActiveController;
use app\entities\Aplication;
use app\modules\api\services\LoginRestService;
use app\modules\api\services\SearchRestService;

class DirectoryController extends ActiveController
{

    public $modelClass = 'app\entities\Aplication';

    use \app\modules\api\traits\Aplication;

    private $serviceLogin;
    private $serviceSearch;

    public function __construct(
        $id,
        $module,
        LoginRestService $serviceLogin,
        SearchRestService $serviceSearch,
        $config = []
    ) {
        parent::__construct($id, $module, $config);
        $this->serviceLogin = $serviceLogin;
        $this->serviceSearch = $serviceSearch;
    }

    public function actionDoctor()
    {
        $params = Yii::$app->request->get();
        if($params['lang'])
            Yii::$app->language=$params['lang'];
        if (!isset($params['token']))
            throw new BadRequestHttpException(Yii::t('error','Token'));
        $user = $this->serviceLogin->auth($params['token']);
        if(!Yii::$app->user->login($user))
            throw new \Exception(Yii::t('error','User'));
        unset($params['token']);
        unset($params['lang']);
        $doctors = Doctors::find()->all();
        if (!empty($params)) {
            $doctors = Doctors::find()->where($params)->all();
        }
        if (!empty($doctors)) {
            return $doctors;
        }
        return ['success' => 'not find'];

    }

    public function actionSpecialization()
    {
        $params = Yii::$app->request->get();
        if($params['lang'])
            Yii::$app->language=$params['lang'];
        if (!isset($params['token']))
            throw new BadRequestHttpException(Yii::t('error','Token'));

        $user = $this->serviceLogin->auth($params['token']);
        if(!Yii::$app->user->login($user))
            throw new \Exception(Yii::t('error','User'));
        unset($params['token']);
        unset($params['lang']);
        $specialization = Specialization::find()->all();
        if (!empty($params))
            $specialization = Specialization::find()->where($params)->all();

        if (!empty($specialization))
            return $specialization;
        return ['success' => Yii::t('app','Not Find')];
    }

    public function actionScience()
    {
        $params = Yii::$app->request->get();
        if($params['lang'])
            Yii::$app->language=$params['lang'];
        if (!isset($params['token']))
            throw new BadRequestHttpException(Yii::t('error','Token'));
        $user = $this->serviceLogin->auth($params['token']);
        if(!Yii::$app->user->login($user))
            throw new \Exception(Yii::t('error','User'));
        unset($params['token']);
        unset($params['lang']);
        $science= ScienceDegree::find()->all();
        if (!empty($params))
            $science = ScienceDegree::find()->where($params)->all();
        if (!empty($science))
            return $science;
        return ['success' => Yii::t('app','Not Find')];
    }
}