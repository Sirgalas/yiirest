<?php

namespace app\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\entities\CommentAplication;

/**
 * CommentAplicationSearch represents the model behind the search form of `app\entities\CommentAplication`.
 */
class CommentAplicationSearch extends CommentAplication
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'id_aplication'], 'integer'],
            [['title', 'comment', 'create_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = CommentAplication::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'id_aplication' => $this->id_aplication,
            'create_at' => $this->create_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
