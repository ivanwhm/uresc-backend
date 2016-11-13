<?php

/**
 * This is the model class for table "user".
 *
 * @property integer $user_id User unique code
 * @property string $name User full name
 * @property string $email User email address
 * @property string $username Username of the user
 * @property string $password Password of the user
 * @property string $salt Password SALT of the user
 * @property string $status Status of the record
 * @property string $date_created Date of the user was created
 * @property string $date_updated Date of the last updated
 *
 * @property UserAccess[] $userAccess Access of the user through the system
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

namespace app\models;

//Imports
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{

    const STATUS_ACTIVE = 'A';
    const STATUS_INACTIVE = 'I';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_created', 'date_updated'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['email', 'username', 'password', 'salt'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'ID',
            'name' => 'Nome',
            'email' => 'E-mail',
            'username' => 'Usuário',
            'password' => 'Senha',
            'salt' => 'SALT',
            'status' => 'Status',
            'date_created' => 'Data da criação',
            'date_updated' => 'Data da última atualização',
        ];
    }

    /**
     * Return the access of the user through the system.
     * @return ActiveQuery
     */
    public function getUserAccess()
    {
        return $this->hasMany(UserAccess::className(), ['user_id' => 'user_id']);
    }

    /**
     * Do the password cryptography.
     *
     * @param $password Password
     * @param $key Password Key
     * @return string
     */
    private function passwordCrypt($password, $key) {
        return sha1($key . $password);
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param string|integer $id the ID to be looked for
     * @return User
     */
    public static function findIdentity($id)
    {
        return User::findOne([
            'status' => User::STATUS_ACTIVE,
            'user_id' => $id
        ]);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->user_id;
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        return $this->password;
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return boolean whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        return $this->passwordCrypt($authKey, $this->salt) === $this->getAuthKey();
    }

    /**
     * Returns the full name of the user.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function storeLog($type)
    {
        $log = new UserAccess();
        $log->user_id = $this->user_id;
        $log->type = $type;
        $log->date = new Expression('current_timestamp');
        $log->ip = Yii::$app->getRequest()->getUserIP();
        $log->save(false);
    }
}

