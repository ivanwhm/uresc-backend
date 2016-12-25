<?php
/**
 * This class is responsible to manager the sites's related pages.
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

namespace app\controllers;

//Imports
use app\models\ChangePasswordForm;
use app\models\LoginForm;
use app\models\UserAccess;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'logout', 'index'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout', 'index', 'password'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Display the error page.
     *
     * @return string
     */
    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;

        if ($exception !== null)
        {
            return $this->render('error', [
                    'exception' => $exception,
                ]
            );
        }
    }

    /**
     * Displays the login page.
     *
     * @return string
     */
    public function actionLogin()
    {

        $this->layout = 'login';

        if (!Yii::$app->getUser()->getIsGuest())
        {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->getRequest()->post()) && $model->validate() && $model->login())
        {
            Yii::$app->getUser()->getIdentity()->storeLog(UserAccess::TYPE_CONNECTION);
            return $this->goBack();
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->getUser()->getIdentity()->storeLog(UserAccess::TYPE_DISCONNECTION);
        Yii::$app->getUser()->logout();

        return $this->goHome();
    }

    /**
     * Change password action.
     *
     * @return string
     */
    public function actionPassword()
    {
        $model = new ChangePasswordForm();
        if ($model->load(Yii::$app->getRequest()->post()) && $model->validate() && $model->changePassword())
        {
            return $this->actionLogout();
        }

        return $this->render('password', [
            'model' => $model,
        ]);
    }

}
