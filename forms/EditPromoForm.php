<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 31.01.18
 * Time: 13:42
 */

namespace app\forms;

use app\entities\Promo;
use yii\base\Model;

class EditPromoForm extends Model
{
    public $id;
    public $date_finish;
    public $date_start;
    public $city_id;
    public $status;
    public $name;
    public $remuneration;

    public function __construct(Promo $promo,array $config = [])
    {
        $this->id=$promo->id;
        $this->date_finish=$promo->date_finish;
        $this->date_start=$promo->date_start;
        $this->city_id=$promo->city_id;
        $this->status=$promo->status;
        $this->name=$promo->name;
        $this->remuneration=$promo->remuneration;
        parent::__construct($config);

    }


    public function rules()
    {
        return[
            ['date_finish', 'required', 'message' => 'Date finish has be blank'],
            ['date_start', 'required', 'message' => 'Date start has be blank'],
            ['city_id', 'required', 'message' => 'Need to choose  city'],
            ['status', 'required', 'message' => 'Need to choose status'],
            ['name', 'required', 'message' => 'Name start has be blank'],
            [['name'], 'string', 'max' => 255],
            [[ 'status','remuneration'], 'integer'],
            [['date_start', 'city_id','date_finish'],'safe']
        ];
    }
}