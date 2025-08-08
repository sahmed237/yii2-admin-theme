<?php

/**
 * @copyright Copyright © 2025 Pavilion Unified Solutions. All rights reserved.
 * @author S. Ahmed
 * Email: sadiqahmed237@gmail.com
 */
use yii\db\Migration;

/**
 * Handles the creation of table `{{%notification}}`.
 */
class m250806_163104_create_notification_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%notification}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'message' => $this->text()->null(),
            'category' => $this->string(20)->notNull()->defaultValue('alert'), // message or alert
            'icon' => $this->string()->null(),
            'is_read' => $this->boolean()->defaultValue(false),
            'created_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex('idx-notification-user_id', '{{%notification}}', 'user_id');
        $this->addForeignKey(
            'fk-notification-user_id',
            '{{%notification}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-notification-user_id', '{{%notification}}');
        $this->dropIndex('idx-notification-user_id', '{{%notification}}');
        $this->dropTable('{{%notification}}');
    }
}
