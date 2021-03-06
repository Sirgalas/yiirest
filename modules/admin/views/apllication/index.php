<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
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
            [   'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{view}{delete}',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
