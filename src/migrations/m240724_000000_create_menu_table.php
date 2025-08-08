<?php
use yii\db\Migration;

class m240724_000000_create_menu_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%admin_menu}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer()->null(),
            'label' => $this->string()->notNull(),
            'route' => $this->string()->null(),
            'icon' => $this->string(),
            'order' => $this->integer()->defaultValue(0),
            'visible' => $this->boolean()->defaultValue(true),
            'rbac_permission' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey('fk-admin_menu-parent', '{{%admin_menu}}', 'parent_id', '{{%admin_menu}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-admin_menu-parent', '{{%admin_menu}}');
        $this->dropTable('{{%admin_menu}}');
    }
} 