<?php
/**
 * This class is responsible to manager the Gallery Category CRUD related pages.
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

namespace app\controllers;

//Imports
use app\models\GalleryCategory;
use Exception;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class GalleryCategoryController extends Controller
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
     * Lists all Gallery Category models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => GalleryCategory::find()->orderBy('name'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Gallery Category model.
     *
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Download Gallery model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GalleryCategory();
        $model->status = GalleryCategory::STATUS_ACTIVE;

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
     * Updates an existing Gallery Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id
     * @return mixed
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
     * Deletes an existing Gallery Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id
     * @return mixed
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
            throw new NotFoundHttpException('Não é possível excluir a categoria de galeria selecionada.');
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Gallery Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id
     * @return GalleryCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GalleryCategory::findOne($id)) !== null)
        {
            return $model;
        } else
        {
            throw new NotFoundHttpException('A categoria de galeria solicitada não existe.');
        }
    }
}
