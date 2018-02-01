<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 30.01.18
 * Time: 16:13
 */

namespace app\forms;

use yii\base\Model;
class CityForm extends Model
{
    public $name;
    public function rules(){
        return [
            ['name', 'required', 'message' => 'City has be blank'],
            [['name'], 'string', 'max' => 255],
        ];
    }

}