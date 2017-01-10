<?php
/**
 * This class is responsible to manager the Contact CRUD related pages.
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

namespace app\controllers;

//Imports
use app\models\Contact;
use Exception;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ContactController extends Controller
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
     * Lists all Contact models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Contact::find()->orderBy('contact_date desc'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Contact model.
     *
     * @param integer $id Contact ID
     * @return string
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the Contact model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param integer $id Contact ID
     * @return Contact
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contact::findOne($id)) !== null)
        {
            return $model;
        } else
        {
            throw new NotFoundHttpException('A mensagem solicitada não existe.');
        }
    }

    /**
     * Updates an existing Contact model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param integer $id Contact ID
     * @return string
     *
     * @throws NotFoundHttpException if the model cannot be changed
     */
    public function actionAnswer($id)
    {
        $model = $this->findModel($id);

        if (!$model->getIsNoAnswerSent())
        {
            throw new NotFoundHttpException('Este contato já foi respondido.');
        }

        if ($model->load(Yii::$app->request->post()))
        {
            $model->answer_sent = Contact::ANSWER_SENT_YES;
            $model->answer_date = new Expression('current_timestamp');
            $model->answer_user_id = Yii::$app->getUser()->getId();
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else
        {
            return $this->render('answer', [
                'model' => $model,
            ]);
        }
    }

}
