<?php

namespace app\controllers;

use app\entities\Doctors;
use app\entities\User;
use SebastianBergmann\GlobalState\RuntimeException;
use Yii;
use app\entities\Aplication;
use app\search\AplicationSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AplicationController implements the CRUD actions for Aplication model.
 */
class ApllicationController extends Controller
{
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
     * Lists all Aplication models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AplicationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Aplication model.
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
     * Creates a new Aplication model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Aplication();
        $doctors= Doctors::find()->asArray()->all();
        $doctorsTitle=ArrayHelper::map($doctors,'id','title');
        $doctorsSpecialization=ArrayHelper::map($doctors,'id','specialization');
        if (Yii::$app->user->isGuest) {
            $this->redirect(['site/signup']);
        }
        if ($model->load(Yii::$app->request->post()) ) {
            try{
                if(!$model->save())
                    throw new RuntimeException($model->errors());
            }catch(RuntimeException $ex){
                Yii::$app->errorHandler->logException($ex);
                Yii::$app->session->setFlash('error',$ex->getMessage());
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'doctorsTitle'=>$doctorsTitle,
            'doctorsSpecialization'=>$doctorsSpecialization

        ]);
    }

   

    /**
     * Deletes an existing Aplication model.
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

    public function actionSearch(){
        $users=ArrayHelper::map(User::find()->asArray()->all(),'id','username');
        $aplication=ArrayHelper::map(Aplication::find()->where(['user_aplication'=>Yii::$app->user->identity->id])->asArray()->all(),'id','title');
        $model=new Aplication(['scenario' => Aplication::SCENARIO_SEARCH]);
         return $this->render('search',[
            'user'=>$users,
            'model'=>$model,
            'aplication'=>$aplication
        ]);
    }

    /**
     * Finds the Aplication model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Aplication the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Aplication::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


}
