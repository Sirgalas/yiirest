<?php

namespace app\entities;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
/**
 * This is the model class for table "comment_aplication".
 *
 * @property int $id
 * @property int $user_id
 * @property int $id_aplication
 * @property string $title
 * @property string $comment
 * @property string $create_at
 */
class CommentAplication extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment_aplication';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'createdAt',
                'updatedAtAttribute' => 'updatedAt',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'id_aplication'], 'required'],
            [['user_id', 'id_aplication'], 'integer'],
            [['create_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['comment'], 'string', 'max' => 610],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'id_aplication' => 'Id Aplication',
            'title' => 'Title',
            'comment' => 'Comment',
            'create_at' => 'Create At',
        ];
    }

    public function getAplication(){
        return $this->hasOne(Aplication::className(),['id'=>'id_aplication']);
    }
}
