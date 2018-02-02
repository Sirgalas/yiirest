<?php use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\entities\City */

$this->title = 'Update City: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Cities', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $city->name, 'url' => ['view', 'id' => $city->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="city-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
