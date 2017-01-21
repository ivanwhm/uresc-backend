<?php
/**
 * This class is responsible to manager the Center CRUD related pages.
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

namespace app\controllers;

//Imports
use app\components\UreController;
use app\models\Center;
use Exception;
use Yii;
use yii\data\ActiveDataProvider;
use app\models\Settings;
use yii\web\NotFoundHttpException;

class CenterController extends UreController
{

    /**
     * Lists all Center models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Center::find()->orderBy('name'),
            'pagination' => false
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Center model.
     *
     * @param integer $id Center ID
     * @return string
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Center model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return string
     */
    public function actionCreate()
    {
        $model = new Center();
        $mask = Settings::findOne(1)->phone_mask;

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            return $this->redirect(['view', 'id' => $model->id]);
        } else
        {
            return $this->render('create', [
                'model' => $model,
                'mask' => $mask
            ]);
        }
    }

    /**
     * Updates an existing Center model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id Center ID
     * @return string
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $mask = Settings::findOne(1)->phone_mask;

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            return $this->redirect(['view', 'id' => $model->id]);
        } else
        {
            return $this->render('update', [
                'model' => $model,
                'mask' => $mask
            ]);
        }
    }

    /**
     * Deletes an existing Center model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id Center ID
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
            throw new NotFoundHttpException(Yii::t('center', 'You can not delete the selected spiritist center.'));
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Center model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id Center ID
     * @return Center
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Center::findOne($id)) !== null)
        {
            return $model;
        } else
        {
            throw new NotFoundHttpException(Yii::t('center', 'The requested spiritist center does not exist.'));
        }
    }
}
