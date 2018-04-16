<?php

namespace app\entities;

use Yii;

/**
 * This is the model class for table "specialization".
 *
 * @property int $id
 * @property string $title
 * @property string $coment
 */
class Specialization extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'specialization';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['coment'], 'string'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'coment' => 'Coment',
        ];
    }
}
