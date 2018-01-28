<?php
namespace app\modules\api\traits;


//use api\modules\v1\filters\HttpShopAuth;

trait Aplication{

    public function behaviors()
    {
        $behaviors = parent::behaviors();

        /*//Чтобы пользоваться нашим API посредством ajax-запросов с других доменов
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::className(),
        ];

        $behaviors['authenticator'] = [
            'class' => HttpShopAuth::className()
        ];
        //Используем только JSON формат
        $behaviors['contentNegotiator'] = [
            'class' => \yii\filters\ContentNegotiator::className(),
            'formats' => [
                'application/json' => \yii\web\Response::FORMAT_JSON,
            ],
        ];

        return $behaviors;*/
    }

    /**
     * 
     * @return array
     */
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        //unset($actions['view']);
        //unset($actions['create']);
        unset($actions['update']);
        unset($actions['delete']);
        //unset($actions['options']);
        return $actions;
    }
    
    
    protected function sendError($error)
    {
        $this->setHeader(400);
        return array('status' => 0, 'error_code' => 400, 'errors' => $error);
    }
}
