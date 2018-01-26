<?php
/**
 * @var $model app\entities\CommentAplication
 */
?>
<div class="col-md-12">
    <h3><?= $model->title ?></h3>
    <div class="col-md-12"> <?=$model->comment; ?></div>
    <div class="col-md-6"><?= date('d:M:Y',$model->create_at); ?></div>
    <div class="col-md-6"><?= $model->user->username; ?></div>
</div>
