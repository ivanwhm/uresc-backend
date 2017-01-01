<?php
/**
 * This class is responsible to manager the News CRUD related pages.
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

namespace app\controllers;

//Imports
use app\models\News;
use Exception;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class NewsController extends Controller
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
     * Lists all News models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => News::find()->orderBy('title'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single News model.
     *
     * @param integer $id News ID
     * @return string
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id News ID
     * @return News
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null)
        {
            return $model;
        } else
        {
            throw new NotFoundHttpException('A notícia solicitada não existe.');
        }
    }

    /**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return string
     */
    public function actionCreate()
    {
        $model = new News();
        $model->published = News::PUBLISHED_NO;

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
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id News ID
     * @return string
     *
     * @throws NotFoundHttpException if the model cannot be changed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->published == News::PUBLISHED_YES)
        {
            throw new NotFoundHttpException('Notícias publicadas não podem ser alteradas.');
        }

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
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id News ID
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
            throw new NotFoundHttpException('Não é possível excluir a notícia selecionada.');
        }

        return $this->redirect(['index']);
    }


    /**
     * Publish an existing News model.
     * If publish is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id News ID
     * @return string
     */
    public function actionPublished($id)
    {
        $model = $this->findModel($id);
        $model->published = News::PUBLISHED_YES;
        $model->save(false);

        return $this->redirect(['index']);
    }

    /**
     * Unpublished an existing News model.
     * If unpublished is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id News ID
     * @return string
     */
    public function actionUnpublished($id)
    {
        $model = $this->findModel($id);
        $model->published = News::PUBLISHED_NO;
        $model->save(false);

        return $this->redirect(['index']);
    }
}
