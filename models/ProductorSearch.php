<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Productor;

/**
 * ProductorSearch represents the model behind the search form of `app\models\Productor`.
 */
class ProductorSearch extends Productor
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idProductor', 'cuit', 'idLocalidad', 'idProvincia', 'numeroCalle', 'numeroTelefono'], 'integer'],
            [['nombre', 'nombreCalle', 'facebook', 'Instagram', 'twitter', 'web'], 'safe'],
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
        $query = Productor::find();

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
            'idProductor' => $this->idProductor,
            'cuit' => $this->cuit,
            'idLocalidad' => $this->idLocalidad,
            'idProvincia' => $this->idProvincia,
            'numeroCalle' => $this->numeroCalle,
            'numeroTelefono' => $this->numeroTelefono,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'nombreCalle', $this->nombreCalle])
            ->andFilterWhere(['like', 'facebook', $this->facebook])
            ->andFilterWhere(['like', 'Instagram', $this->Instagram])
            ->andFilterWhere(['like', 'twitter', $this->twitter])
            ->andFilterWhere(['like', 'web', $this->web]);

        return $dataProvider;
    }
}
