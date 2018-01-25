<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 25.01.18
 * Time: 23:12
 */

namespace app\forms;

use yii\base\Model;
use yii\base\InvalidParamException;
use app\entities\User;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

}