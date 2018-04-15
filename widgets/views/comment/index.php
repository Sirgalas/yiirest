<?php
/** @var $model  app\entities\CommentAplication */

use yii\widgets\ListView;?>
<?= $this->render('_form',[
    'id_apppication'=>$id_apppication,
    'model'=>$model
]); ?>

<?= ListView::widget([
    'dataProvider' =>$commentProvider,
    'itemView' => '_comment',

]) ?>

