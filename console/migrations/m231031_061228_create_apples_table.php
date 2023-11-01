<?php

use yii\db\Migration;

/**
 * Создается таблица "Яблоки".
 */
class m231031_061228_create_apples_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT "Яблоки"';
        };

        $this->createTable('{{%apples}}', [
            'id' => $this->primaryKey(),
            'color' => $this->string(30)->comment('Цвет'),
            'date_growing' => $this->integer()->comment('Дата появления'),
            'date_fall' => $this->integer()->comment('Дата падения'),
            'status' => $this->integer()->comment('Статус (на дереве / упало)'),
            'eat' => $this->integer()->comment('Cколько съели'),

        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%apples}}');
    }
}
