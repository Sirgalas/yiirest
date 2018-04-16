<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 17.04.18
 * Time: 0:19
 */

namespace app\modules\admin\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{

    public function actionIndex(){
        return $this->render('index');
    }
}