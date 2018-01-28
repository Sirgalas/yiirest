<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 27.01.18
 * Time: 12:57
 */

namespace app\controllers;

use app\entities\CommentAplication;
use app\forms\ResetPasswordForm;
use SebastianBergmann\GlobalState\RuntimeException;
use Yii;
use yii\web\BadRequestHttpException;
use app\services\PasswordResetService;
use yii\web\Controller;

class OutherController extends Controller
{
    private $service;

    public function __construct($id, $module, PasswordResetService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    public function actionHello(){
       return "Hell0";
    }

    public function actionConfirm($token)
    {
        try {
            $this->service->validateToken($token);
        } catch (\DomainException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        $form = new ResetPasswordForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->service->reset($token, $form);
                Yii::$app->session->setFlash('success', 'New password saved.');
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
            return $this->goHome();
        }

        return $this->render('confirm', [
            'model' => $form,
        ]);
    }
    public function actionCommentCreate(){
        $entities= new CommentAplication();

        if($entities->load(Yii::$app->request->post())){
            try{
                if(!$entities->save())
                    throw new RuntimeException('comment not save');
                return $this->redirect(['apllication/view/','id'=>$entities->id_aplication]);
            }catch (RuntimeException $ex){
                Yii::$app->errorHandler->logException($ex);
                Yii::$app->session->setFlash('error',$ex->getMessage());
            }
        }
    }

}