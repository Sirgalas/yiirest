<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\entities\Doctors */

$this->title = Yii::t('app','Update').' '.$model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Doctors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app','Update');
?>
<div class="doctors-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'specialization'=>$specialization,
        'science'=>$science
    ]) ?>

</div>
