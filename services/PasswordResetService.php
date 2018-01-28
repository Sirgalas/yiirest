<?php


namespace app\services;


use Yii;
use app\entities\User;
use yii\mail\MailerInterface;

class PasswordResetService
{
    private $suportEmail;
    private $mailer;

    public function __construct($suportEmail, MailerInterface $mailer)
    {
        $this->suportEmail = $suportEmail;
        $this->mailer = $mailer;
    }

    public function request($form)
    {
        /* @var $user User */
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $form->email,
        ]);

        if (!$user) {
            throw new \DomainException('User not found');
        }

        $user->requestPasswordReset();

        if (!$user->save()) {
            throw new \RuntimeException('Saving Error');
        }


        $sent = $this
            ->mailer
            ->compose(
                [
                    'html' => 'reset/passwordResetToken-html',
                    'text' => 'reset/passwordResetToken-text'
                ],
                ['user' => $user]
            )
            ->setFrom($this->suportEmail)
            ->setTo($user->email)
            ->setSubject('Password reset for ' . Yii::$app->name)
            ->send();

        if (!$sent) {
            throw new \RuntimeException('Sent Error');
        }
    }

    public function validateToken($token)
    {

        if (empty($token) || !is_string($token))
            throw new \DomainException("Paasword reset token cannot be blank");

        if (!User::findByPasswordResetToken($token)) {
            throw new \DomainException('Wrong password resset token');
        }
    }

    public function reset($token, $form)
    {
        $user = User::findByPasswordResetToken($token);

        if (!$user)
            \DomainException('User is not find');

        $user->resetPassword($form->password);
        if (!$user->save()) {
        }
    }
}
