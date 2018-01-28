<?php

/* @var $this yii\web\View */
/* @var $user \app\entities\User */

$resetLink = Yii::$app->get('urlManager')->createAbsoluteUrl(['outher/confirm', 'token' => $user->password_reset_token]);
?>
Hello <?= $user->username ?>,

Follow the link below to reset your password:

<?= $resetLink ?>
