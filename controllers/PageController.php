<?php
/**
 * This class is responsible to manager the Page CRUD related pages.
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

namespace app\controllers;

//Imports
use app\components\UreController;
use app\models\Menu;
use app\models\Page;
use Exception;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class PageController extends UreController
{

    /**
     * Lists all Page models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Page::find()->orderBy('name'),
            'pagination' => false
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Page model.
     *
     * @param integer $id Page ID
     * @return string
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Page model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return string
     */
    public function actionCreate()
    {
        $model = new Page();

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            $menu = new Menu();
            $menu->name = $model->name;
            $menu->type = Menu::TYPE_PAGE;
            $menu->visible = Menu::VISIBLE_YES;
            $menu->order = 999;
            $menu->page_id = $model->id;
            $menu->save(false);

            return $this->redirect(['view', 'id' => $model->id]);
        } else
        {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Page model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id Page ID
     * @return string
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            $menu = Menu::findOne(['page_id' => $model->id]);
            if ($menu instanceof Menu)
            {
                $menu->name = $model->name;
                $menu->save(false);
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else
        {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates a page of an existing Page model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id Page ID
     * @return string
     */
    public function actionInfo($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            return $this->redirect(['info', 'id' => $model->id]);
        } else
        {
            return $this->render('info', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Page model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param integer $id Page ID
     * @return string
     *
     * @throws NotFoundHttpException if the model cannot be deleted
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        try
        {
            $menu = Menu::findOne(['page_id' => $model->id]);
            if ($menu instanceof Menu)
            {
                $menu->delete();
            }
            $model->delete();
        } catch (Exception $ex)
        {
            throw new NotFoundHttpException(Yii::t('page', 'You can not delete the selected page.'));
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Page model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id Page ID
     * @return Page
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Page::findOne($id)) !== null)
        {
            return $model;
        } else
        {
            throw new NotFoundHttpException(Yii::t('page', 'The requested page does not exist.'));
        }
    }
}
