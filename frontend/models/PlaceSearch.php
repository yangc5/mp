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
            [['id', 'place_type', 'status', 'created_by', 'created_at', 'updated_at'], 'integer'],
            [['name', 'ext_id', 'ext_reference'], 'safe'],
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
        $query = Place::find();

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
            ->andFilterWhere(['like', 'ext_id', $this->ext_id])
            ->andFilterWhere(['like', 'ext_reference', $this->ext_reference]);

        return $dataProvider;
    }
}
