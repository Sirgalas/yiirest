<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use lajax\languagepicker\Component;

/* @var $this yii\web\View */
/* @var $searchModel app\search\AplicationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app','Aplications');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-aplication-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            [
              'attribute'=> 'user_id',
              'value'=> function($model){
                return $model->user->username;
              }
            ],
            [
                'attribute' => 'payment',
                'value' => function($model){
                        return $model->statusPayment;
                }
            ],
            [
                'attribute'=>'specialization_id',
                'label'=>'specialization',
                'value'=>function($model){
                    return $model->specialization->title;
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>$specialization
            ],
            [
                'attribute'=>'science_degree_id',
                'label'=>'Science Degree',
                'value'=>function($model){
                    return $model->scienceDegree->name;
                },
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>$science
            ],
            [   'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{delete}',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
