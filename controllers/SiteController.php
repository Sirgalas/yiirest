<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\forms\SignupForm;
use app\forms\LoginForm;
use app\services\SignupFormService;
use app\services\LoginFormServices;
use app\forms\PasswordResetRequestForm;
use app\forms\ResetPasswordForm;
use app\services\PasswordResetService;
class SiteController extends Controller
{

    private $service;
    private $passwordResetService;
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

        return phpinfo();//$this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $service=new LoginFormServices();
        $form = new LoginForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $user = $service->auth($form);
                Yii::$app->user->login($user);
                return $this->goBack();
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('login', [
            'model' => $form,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


    public function actionSignup()
    {
        $form = new SignupForm();
        if ($form->load(Yii::$app->request->post())&&$form->validate()) {
            try{
                $user= (new SignupFormService())->signup($form);
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }catch (\DomainException $ex){
                Yii::$app->session->setFlash('error', $ex->getMessage());
            }
        }
        return $this->render('signup', [
            'model' => $form,
        ]);
    }

    public function actionRequestPasswordReset()
    {
        $form = new PasswordResetRequestForm();
        $passwordResetService=new PasswordResetService();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $passwordResetService->request($form);
                return $this->goHome();
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('requestPasswordResetToken', [
                'model'=>$form]
        );
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        $passwordResetService=new PasswordResetService();
        try {
            $passwordResetService->validateToken($token);
        } catch (\DomainException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        $form = new ResetPasswordForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate() && $form->resetPassword()) {
            try{
                $passwordResetService->reset($token,$form);
                Yii::$app->session->setFlash('success','New password save.');
                return $this->goHome();
            }
            catch (\DomainException $e){
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error',$e->getMessage());
            }
        }
        return $this->render('resetPassword', [
            'model' => $form,
        ]);
    }
}
