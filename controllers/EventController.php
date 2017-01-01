<?php
/**
 * This class is responsible to manager the Event CRUD related pages.
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

namespace app\controllers;

//Imports
use app\models\Event;
use Exception;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class EventController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Event models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Event::find()->orderBy('date desc'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Event model.
     *
     * @param integer $id Event ID
     * @return string
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Event model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return string
     */
    public function actionCreate()
    {
        $model = new Event();

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            return $this->redirect(['view', 'id' => $model->id]);
        } else
        {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Event model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id Event ID
     * @return string
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            return $this->redirect(['view', 'id' => $model->id]);
        } else
        {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Event model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id Event ID
     * @return string
     *
     * @throws NotFoundHttpException if the model cannot be deleted
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        try
        {
            $model->delete();
        } catch (Exception $ex)
        {
            throw new NotFoundHttpException('Não é possível excluir o evento selecionado.');
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Event model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id Event ID
     * @return Event
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Event::findOne($id)) !== null)
        {
            return $model;
        } else
        {
            throw new NotFoundHttpException('O evento solicitado não existe.');
        }
    }
}
