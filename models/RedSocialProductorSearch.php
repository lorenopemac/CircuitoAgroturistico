<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RedsocialProductor;

/**
 * RedSocialProductorSearch represents the model behind the search form of `app\models\RedsocialProductor`.
 */
class RedSocialProductorSearch extends RedsocialProductor
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idRedsocial_Productor', 'idRed_social', 'idProductor'], 'integer'],
            [['direccion'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = RedsocialProductor::find();

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
            'idRedsocial_Productor' => $this->idRedsocial_Productor,
            'idRed_social' => $this->idRed_social,
            'idProductor' => $this->idProductor,
        ]);

        $query->andFilterWhere(['like', 'direccion', $this->direccion]);

        return $dataProvider;
    }
}
