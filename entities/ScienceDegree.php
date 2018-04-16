<?php

namespace app\entities;

use Yii;

/**
 * This is the model class for table "science_degree".
 *
 * @property int $id
 * @property string $name
 * @property string $comment
 */
class ScienceDegree extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'science_degree';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comment'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'comment' => 'Comment',
        ];
    }
}
