<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "apples".
 *
 * @property int $id
 * @property string|null $color Цвет (устанавливается при создании объекта случайным)
 * @property int|null $date_growing Дата появления (устанавливается при создании объекта случайным unixTmeStamp)
 * @property int|null $date_fall Дата падения (устанавливается при падении объекта с дерева)
 * @property int|null $status Статус (на дереве / упало)
 * @property int|null $eat Cколько съели (%)
 */
class Apples extends \yii\db\ActiveRecord
{
    public const STATUS_FALL = 0;
    public const STATUS_HAND = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apples';
    }

    /**
     * Статус с label
     * @return array
     */
    public static function getAppelsArrayLabel()
    {
        return [
            self::STATUS_FALL =>  '<span class="badge bg-success">висит</span>',
            self::STATUS_HAND =>  '<span class="badge bg-danger">лежит на земле</span>',

        ];
    }

    /**
     * Роли с label
     * @return array
     */
    public static function statusNameLabel($status)
    {
        $states = self::getAppelsArrayLabel();
        return !empty($states[$status]) ? $states[$status] : $status;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_growing', 'date_fall'], 'safe'],
            [['status', 'eat'], 'integer'],
            [['color'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'color' => 'Цвет',
            'date_growing' => 'Дата появления',
            'date_fall' => 'Дата падения',
            'status' => 'Статус (на дереве / упало)',
            'eat' => 'Cколько съели',
        ];
    }
}
