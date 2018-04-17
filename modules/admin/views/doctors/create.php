<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\entities\Doctors */

$this->title = Yii::t('app','Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Doctors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doctors-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'specialization'=>$specialization,
        'science'=>$science
    ]) ?>

</div>
