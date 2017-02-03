<?php
/**
 * This class is responsible to manager the Centre CRUD related pages.
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

namespace app\controllers;

//Imports
use app\components\UreController;
use app\models\Centre;
use Exception;
use Yii;
use yii\data\ActiveDataProvider;
use app\models\Settings;
use yii\web\NotFoundHttpException;

class CentreController extends UreController
{

    /**
     * Lists all Centre models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Centre::find()->orderBy('name'),
            'pagination' => false
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Centre model.
     *
     * @param integer $id Centre ID
     * @return string
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Centre model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return string
     */
    public function actionCreate()
    {
        $model = new Centre();
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
     * Updates an existing Centre model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id Centre ID
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
     * Deletes an existing Centre model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id Centre ID
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
            throw new NotFoundHttpException(Yii::t('centre', 'You can not delete the selected spiritist centre.'));
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Centre model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id Centre ID
     * @return Centre
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Centre::findOne($id)) !== null)
        {
            return $model;
        } else
        {
            throw new NotFoundHttpException(Yii::t('centre', 'The requested spiritist centre does not exist.'));
        }
    }
}
