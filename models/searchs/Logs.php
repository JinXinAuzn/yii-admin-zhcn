<?php

namespace jx\admin_zhcn\models\searchs;

use jx\admin_zhcn\models\Logs as LogsModel;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class Logs extends LogsModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type'], 'integer'],
            [['route', 'ip'], 'string'],
            [['created_at', 'master_id'], 'safe'],
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
        $query = self::find()->from(parent::tableName() . 'AS a');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pagesize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->joinWith('master AS m');
        $query->andFilterWhere([
            'a.id' => $this->id,
            'a.type' => $this->type,
        ]);
	    if($this->created_at){
		    $query->andFilterWhere([
			    'between',
			    'a.created_at',
			    strtotime($this->created_at),
			    strtotime($this->created_at) + 3600 * 24 - 1,
		    ]);
	    }

        $query->andFilterWhere(['like', 'm.username', $this->master_id]);
        $query->andFilterWhere(['like', 'a.route', $this->route]);
        $query->andFilterWhere(['like', 'a.ip', $this->ip]);
        return $dataProvider;
    }
}
