<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Photo;

/**
 * PhotoSearch represents the model behind the search form about `app\models\Photo`.
 */
class PhotoSearch extends Photo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['file_location', 'description', 'uploaded_time'], 'safe'],
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
        $query = Photo::find()->select('photo.*, SUM(comment.rating) rating')
            ->leftJoin('comment', 'comment.photo_id = photo.id')
            ->groupBy('photo.id')
            ->orderBy('rating DESC');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'uploaded_time' => $this->uploaded_time,
        ]);

        $query->andFilterWhere(['like', 'file_location', $this->file_location])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
