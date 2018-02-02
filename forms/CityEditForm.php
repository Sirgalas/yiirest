<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 30.01.18
 * Time: 16:13
 */

namespace app\forms;

use app\entities\City;
use yii\base\Model;
class CityEditForm extends Model
{
    public $id;
    public $name;
    public function __construct(City $city,array $config = [])
    {
        $this->id=$city->id;
        $this->name=$city->name;
        parent::__construct($config);

    }
    public function rules(){
        return [
            ['name', 'required', 'message' => 'City has be blank'],
            [['name'], 'string', 'max' => 255],
        ];
    }

}