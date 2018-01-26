<?php
/**
* @var $model app\entities\CommentAplication
 */
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
Pjax::begin(['id'=>'pjax_form']);
$form = ActiveForm::begin([
    'action'=>'comment/create'
]);
?>
<?= $form->field($model,'id_aplication')->hiddenInput(['value'=>$id_apppication])->label(false);?>
<?= $form->field($model,'title'); ?>
<?= $form->field($model,'comment')->textarea(); ?>
<div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>
