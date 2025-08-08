<?php
/**
 * @copyright Copyright © 2025 Pavilion Unified Solutions. All rights reserved.
 * @author S. Ahmed
 * Email: sadiqahmed237@gmail.com
 */

namespace sahmed237\yii2admintheme\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\helpers\ArrayHelper;

class AdminMenu extends ActiveRecord
{
    public $visible = true;
    public static function tableName()
    {
        return '{{%admin_menu}}';
    }

    public function rules()
    {
        return [
            [['label'], 'required'],
            [['parent_id', 'order', 'created_at', 'updated_at'], 'integer'],
            [['visible'], 'boolean'],
            [['label', 'route', 'icon', 'rbac_permission'], 'string', 'max' => 255],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => self::class, 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent Menu',
            'label' => 'Menu Label',
            'route' => 'Route',
            'icon' => 'Icon',
            'order' => 'Order',
            'visible' => 'Visible',
            'rbac_permission' => 'Permission',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public function getParent()
    {
        return $this->hasOne(self::class, ['id' => 'parent_id']);
    }

    public function getChildren()
    {
        return $this->hasMany(self::class, ['parent_id' => 'id'])->orderBy(['order' => SORT_ASC]);
    }

    public static function getMenuOptions()
    {
        return self::find()
            ->select(['label', 'id'])
            ->indexBy('id')
            ->column();
    }

    public static function getPermissionList()
    {
        if (Yii::$app->authManager === null) {
            return [];
        }

        return ArrayHelper::map(Yii::$app->authManager->getPermissions(), 'name', 'name');
    }

    public function move($direction)
    {
        $siblings = self::find()
            ->where(['parent_id' => $this->parent_id])
            ->orderBy(['order' => SORT_ASC])
            ->all();

        $currentIndex = null;
        foreach ($siblings as $index => $sibling) {
            if ($sibling->id == $this->id) {
                $currentIndex = $index;
                break;
            }
        }

        if ($direction === 'up' && $currentIndex > 0) {
            $swapWith = $siblings[$currentIndex - 1];
        } elseif ($direction === 'down' && $currentIndex < count($siblings) - 1) {
            $swapWith = $siblings[$currentIndex + 1];
        } else {
            return false;
        }

        $tempOrder = $this->order;
        $this->order = $swapWith->order;
        $swapWith->order = $tempOrder;

        $transaction = Yii::$app->db->beginTransaction();
        try {
            if ($this->save() && $swapWith->save()) {
                $transaction->commit();
                return true;
            }
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }

        return false;
    }

    public static function getRootMenus()
    {
        return self::find()
            ->where(['parent_id' => null])
            ->orderBy(['order' => SORT_ASC])
            ->all();
    }

    public static function getVisibleRootMenus()
    {
        return self::find()
            ->where(['parent_id' => null, 'visible' => true])
            ->orderBy(['order' => SORT_ASC])
            ->all();
    }

    public function getCollapseId()
    {
        return 'sidebar' . str_replace([' ', '/', '-'], '', ucwords($this->label));
    }

}
