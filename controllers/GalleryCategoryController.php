<?php
/**
 * This class is responsible to manager the Gallery Category CRUD related pages.
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

namespace app\controllers;

//Imports
use app\components\UreController;
use app\models\GalleryCategory;
use Exception;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class GalleryCategoryController extends UreController
{

    /**
     * Lists all Gallery Category models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => GalleryCategory::find()->orderBy('name'),
            'pagination' => false
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Gallery Category model.
     *
     * @param integer $id Gallery Category ID
     * @return string
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Gallery Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return string
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
     * @param integer $id Gallery Category ID
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
     * Deletes an existing Gallery Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id Gallery Category ID
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
            throw new NotFoundHttpException(Yii::t('gallery_category', 'You can not delete the selected gallery\'s category.'));
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Gallery Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id Gallery Category ID
     * @return GalleryCategory
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GalleryCategory::findOne($id)) !== null)
        {
            return $model;
        } else
        {
            throw new NotFoundHttpException(Yii::t('gallery_category', 'The requested gallery\'s category does not exist.'));
        }
    }
}
