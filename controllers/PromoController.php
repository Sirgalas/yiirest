<?php

namespace app\controllers;

use app\forms\PromoForm;
use app\forms\EditPromoForm;
use app\services\PromoFormServices;
use Yii;
use app\entities\Promo;
use app\search\PromoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PromoController implements the CRUD actions for Promo model.
 */
class PromoController extends Controller
{
    private $service;
    public function __construct(string $id,  $module, PromoFormServices $services, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service=$services;
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Promo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PromoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Promo model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Promo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new PromoForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try{
                $promo= $this->service->create($form);
                return $this->redirect(['view', 'id' => $promo->id]);
            }catch (\DomainException $ex){
                Yii::$app->session->setFlash('error', $ex->getMessage());
            }
        }

        return $this->render('create', [
            'model' => $form,
        ]);
    }

    /**
     * Updates an existing Promo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $promo = $this->findModel($id);
        $form= new EditPromoForm($promo);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try{
                $promo= $this->service->create($form);
                return $this->redirect(['view', 'id' => $promo->id]);
            }catch (\DomainException $ex){
                Yii::$app->session->setFlash('error', $ex->getMessage());
            }
        }
        return $this->render('update', [
            'model' => $form,
            'promo'=> $promo
        ]);
    }

    /**
     * Deletes an existing Promo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Promo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Promo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Promo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
