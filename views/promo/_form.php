<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\entities\Promo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="promo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true,'readonly'=>($model->status===$promo::STATUS_NO)?true:false]) ?>

    <?= $form->field($model, 'date_start')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Enter start promo '],
        'value' => date('d-M-Y', time()),
        'disabled' => ($model->status===$promo::STATUS_NO)?true:false,
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd 00:00:00'
        ]
    ]);?>

    <?= $form->field($model, 'date_finish')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Enter finsh promo '],
        'value' => date('d-M-Y', time()),
        'disabled' => ($model->status===$promo::STATUS_NO)?true:false,
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd 23:59:59'
        ]
    ]);?>

    <?= $form->field($model, 'sity_id')->widget(Select2::classname(), [
        'data' => $city,
        'language' => 'en',
        'options' => ['placeholder' => 'Select a state '],
        'disabled' => ($model->status===$promo::STATUS_NO)?true:false,
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'status')->dropDownList($promo::$statusArr)?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
