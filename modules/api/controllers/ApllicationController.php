<?php

namespace app\modules\api\controllers;


use Yii;

use api\models\User;
use yii\web\BadRequestHttpException;
use yii\rest\ActiveController;

class ApllicationController extends ActiveController
{

    public $modelClass = 'api\models\User';

    use \app\modules\api\traits\Aplication;

    public function actionСreate(){

    }
    public function actionSearch(){
    }
}