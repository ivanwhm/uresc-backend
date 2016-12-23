<?php
/**
 * ChangePasswordForm is the model behind the site page to change the user' password.
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
     * @var string $oldPassword Old password
     */
    public $oldPassword;

    /**
     * @var string $newPassword New password
     */
    public $newPassword;

    /**
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
            [['repeatNewPassword'], 'compare', 'compareAttribute' => 'newPassword', 'message' => 'As senhas informadas não são iguais.'],
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
            'oldPassword' => 'Senha atual',
            'newPassword' => 'Nova senha',
            'repeatNewPassword' => 'Repetir a nova senha',
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
        if (!$this->hasErrors()) {
            $user = Yii::$app->getUser()->getIdentity();

            if (!$user || !$user->validateAuthKey($this->oldPassword)) {
                $this->addError($attribute, 'A senha atual não é válida.');
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