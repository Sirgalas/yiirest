<?php


namespace app\widgets;

use app\entities\CommentAplication;
use yii\base\Widget;
use yii\data\ActiveDataProvider;

class Comment extends Widget
{
    public $id_application;

    public function run()
    {
        $commentProvider= new ActiveDataProvider([
            'query' => $this->getComment(),
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);

       return $this->render('comment/index',[
           'id_apppication'=>$this->id_application,
           'model'=> new CommentAplication(),
           'commentProvider'=> $commentProvider
       ]);
    }

    private function getComment(){
        return CommentAplication::find()->where(['id_aplication'=>$this->id_application]);
    }

}