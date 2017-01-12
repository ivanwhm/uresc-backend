<?php
/**
 * LoginForm is the model behind the login form.
 *
 * @property User $user This property is read-only.
 *
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

namespace app\models;

//Imports
use Yii;
use yii\base\Model;

class LoginForm extends Model
{

    /**
     * The username.
     *
     * @var string
     */
    public $username;

    /**
     * The password.
     *
     * @var string
     */
    public $password;

    /**
     * All the information about authenticated user.
     *
     * @var User
     */
    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors())
        {
            $user = $this->getUser();

            if (!$user || !$user->validateAuthKey($this->password))
            {
                $this->addError('username', '');
                $this->addError('password', Yii::t('login', 'Invalid username or password!'));
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate())
        {
            return Yii::$app->getUser()->login($this->getUser());
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User
     */
    public function getUser()
    {
        if ($this->_user === false)
        {
            $this->_user = User::findOne([
                'status' => User::STATUS_ACTIVE,
                'username' => $this->username
            ]);
        }

        return $this->_user;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('login', 'Username'),
            'password' => Yii::t('login', 'Password'),
        ];
    }
}
