<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 25.01.18
 * Time: 23:11
 */

namespace app\forms;

use Yii;
use yii\base\Model;
use app\entities\User;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\common\models\User',
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'There is no user with this email address.'
            ],
        ];
    }

}
