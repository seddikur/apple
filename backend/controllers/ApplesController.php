<?php

namespace backend\controllers;

use backend\models\Apples;
use yii\data\ActiveDataProvider;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ApplesController implements the CRUD actions for Apples model.
 */
class ApplesController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Apples models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Apples::find(),

            'pagination' => [
                'pageSize' => 5
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],

        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Apples model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Apples model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Apples();

        $model->color = $this->randomColor();
        $model->date_growing = time();
        $model->status = 0;

        $model->save();
        \Yii::$app->session->setFlash('info', 'Яблоко добавлено');
        return $this->redirect(['index']);
    }


    /**
     * Функция генерация случайного цвета
     */
    public function randomColor()
    {
        $r = mt_rand(0, 255);
        $g = mt_rand(0, 255);
        $b = 0;
        return $r . "," . $g . "," . $b;
    }

    /**
     *  Изменение статуса яблока на "упало"
     */
    public function actionFallToGround($id = null)
    {
        if ($id != null) {
            $model = $this->findModel($id);
            $model->status = 1;
            $model->date_fall = time();
            if ($model->save()) {
                return $this->redirect(['index']);
            } else {
                print_r($model->getErrors());
            }
        }
    }

    /**
     *  Укусить
     */
    public function actionEat($id = null)
    {
        if ($id != null) {
            $model = $this->findModel($id);
            $model->eat = $model->eat + 25;

            if ($model->eat == 100) {
                $this->findModel($id)->delete();
                \Yii::$app->session->setFlash('error', 'Яблоко съедено');
            }

            if ($model->save()) {
                return $this->redirect(['index']);
            } else {
                print_r($model->getErrors());
            }
        }
    }

    /**
     * Функция генерация случайной даты падения
     * - не используется
     */
    public function DatefallToGround()
    {
        //Начальная дата диапозона.
        $start = time();
        //Конечная дата диапозона +1 день к сегодняшней дате.
        $end = time() + 86400;

        return mt_rand($start, $end);
    }

    /**
     * Updates an existing Apples model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Apples model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Apples model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Apples the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Apples::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
