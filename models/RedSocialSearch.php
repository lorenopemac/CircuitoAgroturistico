<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RedSocial;

/**
 * RedSocialSearch represents the model behind the search form of `app\models\RedSocial`.
 */
class RedSocialSearch extends RedSocial
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idRed_social'], 'integer'],
            [['nombre'], 'safe'],
            [['baja'], 'boolean'],
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
        $query = RedSocial::find();

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
            'idRed_social' => $this->idRed_social,
            'baja' => $this->baja,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre]);

        return $dataProvider;
    }
}
