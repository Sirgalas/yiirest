<?php

namespace app\modules\api\controllers;


use app\entities\Aplication;
use Yii;
use yii\rest\ActiveController;

use yii\web\BadRequestHttpException;
use app\modules\api\entities\User;
use app\entities\CommentAplication;
use app\modules\api\services\LoginRestService;
use yii\web\NotFoundHttpException;

/**
 * Order Controller API
 *
 */
class CommentApllicationController extends ActiveController
{



    public $modelClass = 'app\entities\CommentApllication';

    use \app\modules\api\traits\Aplication;

    private $serviceLogin;

    public function __construct($id, $module, LoginRestService $serviceLogin, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->serviceLogin = $serviceLogin;
    }
    /**
     * Добавления нового сайта
     * @return type
     */
    public function actionAdd()
    {
        $params=Yii::$app->request->get();
        $user=$this->serviceLogin->auth($params['token']);
        Yii::$app->user->login($user);
        $aplication= Aplication::findOne($params['id']);
        if(!$aplication)
            throw new BadRequestHttpException('Apllication not find');
        $comment= new CommentAplication([
            'id_aplication'=>$aplication->id,
            'title'=>$params['title'],
            'comment'=>$params['content'],
        ]);
        try{
            if(!$comment->save())
                throw new BadRequestHttpException('Error data' . json_encode($comment->errors));
        }catch (BadRequestHttpException $ex){
            $this->setHeader(404);
            return $ex->getMessage();
        }
        $this->setHeader(200);
        return array('comment'=>'comment save from apllication_id '.$aplication->id);

    }

    public function actionSearch(){
        $params=Yii::$app->request->get();
        $aplication= Aplication::findOne($params['id']);
        if(!$aplication)
            throw new BadRequestHttpException('Apllication not find');
        $comments= CommentAplication::find()->where(['id_aplication'=>$aplication->id])->all();
        if(!$comments)
            throw new BadRequestHttpException('Not find comment this apllication');
        foreach ($comments as $comment){
            if(!is_object($comment->user))
                throw new BadRequestHttpException('Wrong user from comment id '.$comment->id);
            $result[]=array(
                'apllication_title'=>$aplication->title,
                'title'=>$comment->title,
                'content'=>$comment->comment,
                'autor'=>$comment->user->username);
        }
        return $result;

    }
}
