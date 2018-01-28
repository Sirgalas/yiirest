<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\widgets\Comment;

/* @var $this yii\web\View */
/* @var $model app\entities\Aplication */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Aplications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aplication-view">

    <h1><?= Html::encode($this->title) ?></h1>

     <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'content',
            [
                    'attribute'=>'create_at',
                    'value'=>function()use($model){
                        return date('d:m:Y',$model->create_at);
                    }
            ],
            [
                    'attribute'=> 'user_aplication',
                    'value'=>function()use($model){
                        return $model->user->username;
                    }
            ],
        ],
    ]) ?>
    <?= Comment::widget(['id_application'=>$model->id]) ?>
</div>
