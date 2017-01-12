<?php
/**
 * ChangePasswordForm is the model behind the site page to change the user's password.
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

namespace app\models;

//Imports
use Yii;
use yii\base\Model;

class ChangePasswordForm extends Model
{
    /**
     * Old password.
     *
     * @var string $oldPassword
     */
    public $oldPassword;

    /**
     * New password.
     *
     * @var string $newPassword
     */
    public $newPassword;

    /**
     * Repeat New password.
     *
     * @var string $repeatNewPassword
     */
    public $repeatNewPassword;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['oldPassword', 'newPassword', 'repeatNewPassword'], 'required'],
            [['repeatNewPassword'], 'compare', 'compareAttribute' => 'newPassword', 'message' => Yii::t('password', 'The entered passwords are differents.')],
            ['oldPassword', 'validatePassword'],
            [['newPassword', 'repeatNewPassword'], 'string', 'min' => 6],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'oldPassword' => Yii::t('password', 'Old password'),
            'newPassword' => Yii::t('password', 'New password'),
            'repeatNewPassword' => Yii::t('password', 'New password (again)'),
        ];
    }

    /**
     * Validates de user's password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors())
        {
            $user = Yii::$app->getUser()->getIdentity();

            if (!$user || !$user->validateAuthKey($this->oldPassword))
            {
                $this->addError($attribute, Yii::t('password', 'The old password is incorrect.'));
            }
        }
    }

    /**
     * Changes de user's password.
     *
     * @return boolean
     */
    public function changePassword()
    {
        $user = Yii::$app->getUser()->getIdentity();
        $user->password = $this->newPassword;
        $user->new_password = $this->repeatNewPassword;
        return $user->save();
    }

}