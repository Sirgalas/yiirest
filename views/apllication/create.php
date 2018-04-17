<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\entities\Aplication */

$this->title = Yii::t('app','Create').' '.Yii::t('app','Aplications');

?>
<div class="aplication-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="aplication-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'content')->textarea(['maxlength' => true]) ?>

        <?= $form->field($model, 'specialization_id')->dropDownList($specialization); ?>

        <?= $form->field($model, 'science_degree_id')->dropDownList($science); ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app','Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
