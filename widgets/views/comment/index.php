<?php
/** @var $model  app\entities\CommentAplication */

use yii\widgets\Pjax;
use yii\widgets\ListView;?>
<?= $this->render('_form',[
    'id_apppication'=>$id_apppication,
    'model'=>$model
]); ?>
<?php Pjax::begin(['id'=>'pjax_reload']) ?>
<?= ListView::widget([
    'dataProvider' =>$commentProvider,
    'itemView' => '_comment',

]) ?>
<?php Pjax::end(); ?>
