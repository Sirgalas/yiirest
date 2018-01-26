<?php
/**
* @var $model app\entities\CommentAplication
 */
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
Pjax::begin(['id'=>'pjax_form']);
$fotm = ActiveForm::begin([
    'action'=>'comment/create'
]);
?>
<?= $fotm->field($model,'id_aplication')->hiddenInput(['value'=>$id_apppication])->label(felse);?>
<?= $form->field($model,'title'); ?>
<?= $fotm->field($model,'comment')->textarea(); ?>
<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>
