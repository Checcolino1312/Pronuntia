<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Assistito;

/**
 * AssistitoSearch represents the model behind the search form of `app\models\Assistito`.
 */
class AssistitoSearch extends Assistito
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['eta', 'id_logopedista', 'id_caregiver'], 'integer'],
            [['nome', 'cognome', 'diagnosi'], 'safe'],
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
        $query = Assistito::find();

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
            'eta' => $this->eta,
            'id_logopedista' => $this->id_logopedista,
            'id_caregiver' => $this->id_caregiver,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'cognome', $this->cognome])
            ->andFilterWhere(['like', 'diagnosi', $this->diagnosi]);

        return $dataProvider;
    }
}
