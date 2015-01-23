<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Place;

/**
 * PlaceSearch represents the model behind the search form about `frontend\models\Place`.
 */
class PlaceSearch extends Place
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_by'], 'required'],        
            [['id', 'place_type', 'status', 'created_by', 'created_at', 'updated_at'], 'integer'],
            [['name', 'google_place_id', 'slug', 'website', 'full_address', 'vicinity', 'notes'], 'safe'],
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
        $query = Place::find()->joinWith('user_place')->where(['user_id' => Yii::$app->user->getId()]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'place_type' => $this->place_type,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'google_place_id', $this->google_place_id])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'website', $this->website])
            ->andFilterWhere(['like', 'full_address', $this->full_address])
            ->andFilterWhere(['like', 'vicinity', $this->vicinity])
            ->andFilterWhere(['like', 'notes', $this->notes]);
        
        return $dataProvider;
    }
}
