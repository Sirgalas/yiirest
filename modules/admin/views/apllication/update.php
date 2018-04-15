<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\entities\Aplication */

$this->title = 'Create Aplication';
$this->params['breadcrumbs'][] = ['label' => 'Aplications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aplication-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="aplication-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'content')->textarea(['maxlength' => true]) ?>

        <?= $form->field($model , 'payment')->dropDownList($model->allPaymentStatus) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>