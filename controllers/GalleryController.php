<?php
/**
 * This class is responsible to manager the Gallery CRUD related pages.
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

namespace app\controllers;

//Imports
use app\components\UreController;
use app\models\Gallery;
use app\models\GalleryFiles;
use Exception;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\FileHelper;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

class GalleryController extends UreController
{

    /**
     * Lists all Gallery models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Gallery::find()->orderBy('name'),
            'pagination' => false
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Gallery model.
     *
     * @param integer $id Gallery ID
     * @return string
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $dataProvider = new ActiveDataProvider([
            'query' => GalleryFiles::find()->onCondition(['gallery_id' => $model->id])->orderBy('filename')
        ]);

        return $this->render('view', [
            'model' => $model,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Finds the Gallery model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id Gallery ID
     * @return Gallery
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Gallery::findOne($id)) !== null)
        {
            return $model;
        } else
        {
            throw new NotFoundHttpException(Yii::t('gallery', 'The requested gallery does not exist.'));
        }
    }

    /**
     * Creates a new Gallery model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return string
     */
    public function actionCreate()
    {
        $model = new Gallery();
        $model->status = Gallery::STATUS_ACTIVE;

        if ($model->load(Yii::$app->getRequest->post()) && $model->save())
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
     * Updates an existing Gallery model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id Gallery ID
     * @return string
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->getRequest()->post()) && $model->save())
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
     * Upload files a existing Gallery model.
     *
     * @param integer $id Gallery ID
     * @return string
     */
    public function actionUpload($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->getRequest()->getIsPost())
        {
            $model->files = UploadedFile::getInstances($model, 'files');
            if ($model->upload()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('upload', ['model' => $model]);
    }


    /**
     * Upload files like links to an existing Gallery model.
     *
     * @param integer $id Gallery ID
     * @return string
     */
    public function actionLink($id)
    {
        $model = new GalleryFiles();
        $model->setScenario('link');
        $model->gallery_id = $id;

        if ($model->load(Yii::$app->getRequest()->post()))
        {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->upload() && $model->save())
            {
                return $this->redirect(['view', 'id' => $model->gallery_id]);
            }
        }

        return $this->render('link', [
            'model' => $model
        ]);
    }

    /**
     * Deletes an existing Gallery model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id Gallery ID
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
            throw new NotFoundHttpException(Yii::t('gallery', 'You can not delete the selected gallery.'));
        }

        return $this->redirect(['index']);
    }

    /**
     * Render an image from gallery.
     *
     * @param $id
     */
    public function actionImage($id)
    {
        if (($model = GalleryFiles::findOne($id)) !== null)
        {
            $this->renderPartial('_image', [
                'model' => $model
            ]);
        }
    }

    /**
     * Drops an specific file.
     *
     * @param $id Gallery File's ID.
     * @return Response
     *
     * @throws NotFoundHttpException
     */
    public function actionDrop($id)
    {
        if (($model = GalleryFiles::findOne($id)) !== null)
        try
        {
            unlink($model->getGallery()->getGalleryDirectory() . $model->filename);
            $model->delete();
        } catch (Exception $ex)
        {
            throw new NotFoundHttpException(Yii::t('gallery', 'You can not delete the selected file.'));
        }

        return $this->redirect(['view', 'id' => $model->gallery_id]);
    }

    /**
     * Drops an group of files.
     *
     * @param $gallery_id Gallery ID.
     * @param $ids Gallery File's ID.
     * @return Response
     *
     * @throws NotFoundHttpException
     */
    public function actionDropsel($gallery_id, $ids)
    {
        $ids = mb_split(',', $ids);
        foreach ($ids as $id)
        {
            if (($model = GalleryFiles::findOne($id)) !== null)
            {
                try
                {
                    unlink($model->getGallery()->getGalleryDirectory() . $model->filename);
                    $model->delete();
                } catch (Exception $ex)
                {

                }
            }

        }
        return $this->redirect(['view', 'id' => $gallery_id]);
    }
}
