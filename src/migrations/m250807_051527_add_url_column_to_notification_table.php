<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%notification}}`.
 */
class m250807_051527_add_url_column_to_notification_table extends Migration
{
// Migration file content
    public function up()
    {
        $this->addColumn('{{%notification}}', 'url', $this->string()->null()->after('message'));
    }

    public function down()
    {
        $this->dropColumn('{{%notification}}', 'url');
    }
}
