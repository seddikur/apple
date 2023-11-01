<?php

use backend\models\Apples;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Яблоки';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .d1 {
        width: 50px;
        height: 50px;
        border-radius: 50%;
    }
</style>
<div class="apples-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Повесить яблоко', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'label' => 'цвет',
                'encodeLabel' => false,
                'format' => 'raw',
                'value' => function ($item) {
                    return '<div class="d1" style="background-color: rgb(' . $item->color . ');">' . $item->color . '</div>';
                },
            ],
            [
                'attribute' => 'date_growing',
                'label' => 'Дата появления',
                'format' => ['date', 'HH:mm dd.MM.Y'],
            ],
            [
                'attribute' => 'date_fall',
                'label' => 'Дата падения',
                'format' => ['date', 'HH:mm dd.MM.Y'],
            ],
            [
                'attribute' => 'Статус',
                'format' => 'raw',
                'value' => function ($model) {
                    return Apples::statusNameLabel($model->status);
                },
            ],
            'eat',
            [
                'class' => ActionColumn::className(),
                'template' => '{action} ',
                'buttons' => [
                    'action' => function ($url, Apples $model) {
                        if ($model->status == 0) {
                            return Html::a(
                                'Стряхнуть',
                                ['apples/fall-to-ground', 'id' => $model->id], ['class' => 'btn btn-success']);
                        }
                    },
                ],
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{action} ',
                'buttons' => [
                    'action' => function ($url, Apples $model) {
                        if ($model->status == 1) {
                            return Html::a(
                                'Укусить',
                                ['apples/eat', 'id' => $model->id], ['class' => 'btn btn-warning']);
                        }
                    },
                ],
            ],

            [
                'class' => ActionColumn::className(),
                'template' => '{delete}',
                'urlCreator' => function ($action, Apples $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
