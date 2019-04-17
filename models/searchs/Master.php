<?php

namespace jx\admin_zhcn\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use jx\admin_zhcn\models\Master as MasterModel;

/**
 * Master represents the model behind the search form about `jx\admin_zhcn\models\Master`.
 */
class Master extends MasterModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status','updated_at'], 'integer'],
            [['username', 'auth_key', 'password_hash', 'password_reset_token', 'email','created_at'], 'safe'],
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
        $query = MasterModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (!$this->validate()) {
            $query->where('1=0');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'updated_at' => $this->updated_at,
        ]);
	    if($this->created_at){
		    $query->andFilterWhere([
			    'between',
			    'created_at',
			    strtotime($this->created_at),
			    strtotime($this->created_at) + 3600 * 24 - 1,
		    ]);
	    }
        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
