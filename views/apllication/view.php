<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\widgets\Comment;

/* @var $this yii\web\View */
/* @var $model app\entities\Aplication */

$this->title = $model->title;

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
            [
                'attribute'=>'specialization_id',
                'label'=>'specialization',
                'value'=>function($model){
                    return $model->specialization->title;
                }
            ],
            [
                'attribute'=>'science_degree_id',
                'label'=>'Science Degree',
                'value'=>function($model){
                    return $model->scienceDegree->name;
                }
            ],
        ],
    ]) ?>
</div>
