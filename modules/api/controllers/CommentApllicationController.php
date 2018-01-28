<?php

namespace app\modules\api\controllers;


use Yii;
use yii\rest\ActiveController;

use yii\web\BadRequestHttpException;
use api\models\User;
use yii\web\NotFoundHttpException;

/**
 * Order Controller API
 *
 */
class CommentApllicationController extends ActiveController
{



    public $modelClass = 'app\entities\CommentApllication';

    use \app\modules\api\traits\Aplication;
    /**
     * Добавления нового сайта
     * @return type
     */
    public function actionAdd()
    {


    }

    public function actionSearch(){

    }
}
