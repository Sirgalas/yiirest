<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\entities\Promo */

$this->title = 'Update Promo: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Promos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="promo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'city'=>$city,
        'promo'=>$promo
    ]) ?>

</div>
