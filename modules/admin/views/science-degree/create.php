<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\entities\ScienceDegree */

$this->title = 'Create Science Degree';
$this->params['breadcrumbs'][] = ['label' => 'Science Degrees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="science-degree-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
