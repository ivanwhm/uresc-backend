<?php
/**
 * This class is responsible to manager the Menu CRUD related pages.
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

namespace app\controllers;

//Imports
use app\components\UreController;
use app\models\Menu;
use dixonstarter\togglecolumn\actions\ToggleAction;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class MenuController extends UreController
{

    /**
     * @inheritdoc
     */
    public function actions(){
        return [
            'toggle-update' => [
                'class' => ToggleAction::className(),
                'modelClass' => Menu::className(),
                'attribute' => 'visible',
            ]
        ];
    }

    /**
     * Lists all Menu models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Menu::find()->orderBy('order'),
            'pagination' => false,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Finds the Menu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id Menu ID
     * @return Menu
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Menu::findOne($id)) !== null)
        {
            return $model;
        } else
        {
            throw new NotFoundHttpException(Yii::t('menu', 'The requested menu does not exist.'));
        }
    }

    /**
     * Updates an existing Menu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id Menu ID
     * @return string
     *
     * @throws NotFoundHttpException if the model cannot be changed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        Yii::$app->request->post();
        $model->save();
        return $this->redirect(['index']);
    }

}
