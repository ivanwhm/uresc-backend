<?php
/**
 * This class is responsible to manager the News CRUD related pages.
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

namespace app\controllers;

//Imports
use app\components\UreController;
use app\models\News;
use Exception;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\web\NotFoundHttpException;

class NewsController extends UreController
{

    /**
     * Lists all News models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => News::find()->orderBy('title'),
            'pagination' => false
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
            throw new NotFoundHttpException(Yii::t('news', 'The requested news does not exist.'));
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

        if ($model->getIsPublished())
        {
            throw new NotFoundHttpException(Yii::t('news', 'Published news can not be updated.'));
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
            throw new NotFoundHttpException(Yii::t('news', 'You can not delete the selected news.'));
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
        $model->date_published = new Expression('current_timestamp');
        $model->user_published = Yii::$app->getUser()->getIdentity()->getId();
        $model->save(false);

        return $this->redirect(['view', 'id' => $model->id]);
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
        $model->date_published = null;
        $model->user_published = null;
        $model->save(false);

        return $this->redirect(['view', 'id' => $model->id]);
    }
}
