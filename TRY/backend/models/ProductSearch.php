<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Product;

/**
 * ProductSearch represents the model behind the search form about `backend\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['prName', 'prImage', 'prShortDesc', 'prLongDesc', 'prStockStatus', 'prStatus', 'prCreatedOn', 'prUpdatedOn'], 'safe'],
            [['prPrice'], 'number'],
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
        $query = Product::find();

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
            'prPrice' => $this->prPrice,
            'prCreatedOn' => $this->prCreatedOn,
            'prUpdatedOn' => $this->prUpdatedOn,
        ]);

        $query->andFilterWhere(['like', 'prName', $this->prName])
            ->andFilterWhere(['like', 'prImage', $this->prImage])
            ->andFilterWhere(['like', 'prShortDesc', $this->prShortDesc])
            ->andFilterWhere(['like', 'prLongDesc', $this->prLongDesc])
            ->andFilterWhere(['like', 'prStockStatus', $this->prStockStatus])
            ->andFilterWhere(['like', 'prStatus', $this->prStatus]);

        return $dataProvider;
    }
}
