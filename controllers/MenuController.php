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
use yii\helpers\Json;
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
            'query' => Menu::find()->orderBy('order')->indexBy('id'),
            'pagination' => false,
        ]);

        //Make the order column editable.
        if (Yii::$app->request->post('hasEditable'))
        {
            $menuId = Yii::$app->request->post('editableKey');
            $model = Menu::findOne($menuId);
            $out = Json::encode(['output'=>'', 'message'=>'']);

            $posted = current($_POST['Menu']);
            $post = ['Menu' => $posted];

            if ($model->load($post))
            {
                $model->save();
                $output = '';
                if (isset($posted['order']))
                {
                    $output = Yii::$app->formatter->asInteger($model->order);
                }
                $out = Json::encode(['output'=>$output, 'message'=>'']);
            }
            echo $out;
            return;
        }

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

}
