<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\search\PromoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Promos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="promo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Promo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'date_start',
            'date_finish',
            [
                'attribute'=> 'city_id',
                'format'=>'raw',
                'value'=> function ($model){
                    $name='';
                    foreach ($model->city as $city){
                        $name.='<p>'.$city->name.'</p>';
                    }
                    return $name;
                }
            ],
            [
                'attribute'=>'status',
                'value'=>function($model){
                    return $model::$statusArr[$model->status];
                }
            ],
            'remuneration',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
