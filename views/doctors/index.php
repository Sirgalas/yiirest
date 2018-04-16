<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\search\DoctorsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Doctors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doctors-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Doctors', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
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
    ]); ?>
</div>
