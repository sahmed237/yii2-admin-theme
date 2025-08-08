<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%admin_theme_setting}}`.
 */
class m250728_214320_create_admin_theme_setting_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%admin_theme_setting}}', [
            'id' => $this->primaryKey(),
            'key' => $this->string(255)->notNull()->unique(),
            'value' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%admin_theme_setting}}');
    }
}
