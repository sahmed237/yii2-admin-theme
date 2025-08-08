<?php

namespace sahmed237\yii2admintheme\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%admin_theme_setting}}".
 *
 * @property string $key
 * @property string|null $value
 */
class AdminThemeSetting extends ActiveRecord
{

    public $logo_light_lg;
    public $logo_light_sm;
    public $logo_dark_lg;
    public $logo_dark_sm;



    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%admin_theme_setting}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['key'], 'required'],
            [['value'], 'string'],
            [['key'], 'string', 'max' => 255],
            [['key'], 'unique'],
            [['logo_light_lg', 'logo_light_sm', 'logo_dark_lg', 'logo_dark_sm'], 'file', 'extensions' => 'png, jpg, jpeg', 'maxSize' => 1024 * 1024],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'key' => Yii::t('app', 'Key'),
            'value' => Yii::t('app', 'Value'),
        ];
    }
} 