<?php
/**
 * This class is responsible to manager the sites's related pages.
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

namespace app\controllers;

//Imports
use app\components\UreController;
use app\models\Center;
use app\models\ChangePasswordForm;
use app\models\Contact;
use app\models\Event;
use app\models\LoginForm;
use app\models\News;
use app\models\Settings;
use app\models\User;
use app\models\UserAccess;
use Yii;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

class SiteController extends UreController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'index', 'password'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'error'],
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
        return $this->render('index',[
            'contacts' => Contact::getContactsAwaitingAnswer(),
            'events' => Event::getFurtherEvents(),
            'centers' => Center::getCenterCount(),
            'news' => News::getUnpublishedNews()
        ]);
    }

    /**
     * Display the error page.
     *
     * @return string
     */
    public function actionError()
    {
        $exception = Yii::$app->getErrorHandler()->exception;

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
            Yii::$app->getSession()->set('language', Yii::$app->getUser()->getIdentity()->language);
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

    /**
     * Updates a page of an existing Settings model.
     * If update is successful, the browser will be redirected to the 'config' page.
     *
     * @return string
     *
     * @throws NotFoundHttpException If the user cannot be deleted
     */
    public function actionSettings()
    {
        if ((($model = Settings::findOne(1)) !== null) and
            (Yii::$app->getUser()->getIdentity()->getIsCanAccessSettings()))
        {
            if ($model->load(Yii::$app->getRequest()->post()) && $model->save())
            {
                return $this->redirect(['settings']);
            } else
            {
                return $this->render('settings', [
                    'model' => $model,
                ]);
            }
        } else
        {
            throw new NotFoundHttpException(Yii::t('settings', 'The requested setting does not exist.'));
        }
    }

    /**
     * Logout action.
     *
     * @param string $lang Language
     * @return string
     */
    public function actionLanguage($lang)
    {
        //Change de user language
        $user = User::findOne(Yii::$app->getUser()->getId());
        $user->language = $lang;
        $user->password = '';
        $user->new_password = '';
        $user->save(false);
        //Refresh session data
        Yii::$app->getSession()->set('language', $lang);

        return $this->goHome();
    }
}
