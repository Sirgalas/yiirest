<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\search\AplicationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aplication-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id')->widget(Select2::classname(), [
        'data' => $aplication,
        'language' => 'en',
        'options' => ['placeholder' => 'Select a title'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'user_aplication')->widget(Select2::classname(), [
        'data' => $user,
        'language' => 'en',
        'options' => ['placeholder' => 'Select user'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>
    <?= $form->field($model, 'specialization')->widget(Select2::classname(), [
        'data' => $specialization,
        'language' => 'en',
        'options' => ['placeholder' => 'Select a specialization'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'science_degree_id')->widget(Select2::classname(), [
        'data' => $science,
        'language' => 'en',
        'options' => ['placeholder' => 'Select Science degree'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>
    <?= $form->field($model, 'title') ?>
    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
