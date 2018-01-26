<?php
/**
 * Created by PhpStorm.
 * User: Fynjy
 * Date: 25.11.2017
 * Time: 16:36
 */

namespace api\models;

class OrderExternal extends \common\models\OrderExternal
{
    public function fields()
    {
        return [
            'id',
            'amount',
            'comment',
            'created_at',
        ];
    }
}