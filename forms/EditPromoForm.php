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
    public $date_finish;
    public $date_start;
    public $sity_id;
    public $staus;
    public $name;

    public function __construct(Promo $promo,array $config = [])
    {
        $this->date_finish=$promo->date_finish;
        $this->date_start=$promo->date_start;
        $this->sity_id=$promo->sity_id;
        $this->staus=$promo->status;
        $this->name=$promo->name;
        parent::__construct($config);

    }


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