<?php

namespace app\modules\api\controllers;


use yii\rest\ActiveController;


class HelloController extends ActiveController
{

    public $modelClass = 'api\models\User';

    use \app\modules\api\traits\Aplication;

    public function actionHello(){
       return ['hello'=>'World'];
    }
}