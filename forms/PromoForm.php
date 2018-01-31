<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 30.01.18
 * Time: 17:16
 */

namespace app\forms;

use yii\base\Model;
class PromoForm extends Model
{
    public function rules()
    {
        return[
                ['date_finish', 'required', 'message' => 'Date finish has be blank'],
                ['date_start', 'required', 'message' => 'Date start has be blank'],
                ['sity_id', 'required', 'message' => 'Need to choose  city'],
                ['staus', 'required', 'message' => 'Need to choose status'],
                ['name', 'required', 'message' => 'Name start has be blank'],
                [['name'], 'string', 'max' => 255],
                [['date_start', 'date_finish', 'sity_id','staus'], 'integer'],
            ];
    }

}