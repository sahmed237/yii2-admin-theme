<?php
/**
 * @copyright Copyright © 2025 Pavilion Unified Solutions. All rights reserved.
 * @author S. Ahmed
 * Email: sadiqahmed237@gmail.com
 */

namespace sahmed237\yii2admintheme\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class AdminMenuSearch extends AdminMenu
{
    public function rules()
    {
        return [
            [['id', 'parent_id', 'order', 'visible'], 'integer'],
            [['label', 'route', 'icon', 'rbac_permission'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = AdminMenu::find()->with('parent');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'parent_id' => SORT_ASC,
                    'order' => SORT_ASC,
                ]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'order' => $this->order,
            'visible' => $this->visible,
        ]);

        $query->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'route', $this->route])
            ->andFilterWhere(['like', 'icon', $this->icon])
            ->andFilterWhere(['like', 'rbac_permission', $this->rbac_permission]);

        return $dataProvider;
    }
}