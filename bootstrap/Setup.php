<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 25.01.18
 * Time: 22:21
 */

namespace app\bootstrap;

use yii\base\BootstrapInterface;
use Yii;

class Setup  implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $conteiner= \Yii::$container;
        $conteiner->setSingleton(PasswordResetService::class,[],[
            [Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'],
            $app->mailer,
        ]);
        $conteiner->setSingleton(PasswordResetService::class,[],[
            [Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'],
            $app->mailer,
        ]);
    }
}