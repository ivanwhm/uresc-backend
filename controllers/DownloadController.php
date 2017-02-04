<?php
/**
 * This class is responsible to manager the Download CRUD related pages.
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

namespace app\controllers;

//Imports
use app\components\UreController;
use app\models\Download;
use Exception;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class DownloadController extends UreController
{

    /**
     * Lists all Download models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Download::find()->orderBy('name'),
            'pagination' => false
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Download model.
     *
     * @param integer $id Download ID
     * @return string
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Download model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return string
     */
    public function actionCreate()
    {
        $model = new Download();
        $model->status = Download::STATUS_ACTIVE;

        if ($model->load(Yii::$app->getRequest()->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->upload() && ($model->save()))
            {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Download model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id Download ID
     * @return string
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->getRequest()->post()))
        {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->upload() && ($model->save()))
            {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Download model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id Download ID
     * @return string
     *
     * @throws NotFoundHttpException if the model cannot be deleted
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        try
        {
            unlink($model->getCoverDirectory() . $model->cover_filename);
            $model->delete();
        } catch (Exception $ex)
        {
            throw new NotFoundHttpException(Yii::t('download', 'You can not delete the selected download.'));
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Download model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id Download ID
     * @return Download
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Download::findOne($id)) !== null)
        {
            return $model;
        } else
        {
            throw new NotFoundHttpException(Yii::t('download', 'The requested download does not exist.'));
        }
    }


    /**
     * Render an image from cover.
     *
     * @param $id
     */
    public function actionImage($id)
    {
        if (($model = $this->findModel($id)) !== null)
        {
            $this->renderPartial('_image', [
                'model' => $model
            ]);
        }
    }

}
