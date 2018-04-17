<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use lajax\languagepicker\Component;
/* @var $this yii\web\View */
/* @var $model app\search\AplicationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aplication-search">
    <?= (new Component())->detectLanguage(); ?>
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id')->widget(Select2::class, [
        'data' => $aplication,
        'language' => Yii::$app->language,
        'options' => ['placeholder' => Yii::t('app','Select a title')],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'user_aplication')->widget(Select2::class, [
        'data' => $user,
        'language' => Yii::$app->language,
        'options' => ['placeholder' =>  Yii::t('app','Select user')],
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
