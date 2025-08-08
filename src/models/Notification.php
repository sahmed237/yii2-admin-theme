<?php
/**
 * @copyright Copyright © 2025 Pavilion Unified Solutions. All rights reserved.
 * @author S. Ahmed
 * Email: sadiqahmed237@gmail.com
 */

namespace sahmed237\yii2admintheme\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string|null $message
 * @property string $category
 * @property string $url
 * @property string|null $icon
 * @property bool $is_read
 * @property int $created_at
 */
class Notification extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%notification}}';
    }

    public function rules()
    {
        return [
            [['user_id', 'title', 'category', 'created_at'], 'required'],
            [['user_id', 'created_at'], 'integer'],
            [['message'], 'string'],
            [['is_read'], 'boolean'],
            [['title', 'icon'], 'string', 'max' => 255],
//            [['category'], 'in', 'range' => ['message', 'alert']],
            [['url'], 'string', 'max' => 255],

        ];
    }

    public function getUser()
    {
        return $this->hasOne( \Yii::$app->user::class, ['id' => 'user_id']);
    }
}
