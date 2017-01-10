<?php
/**
 * This is the model class for table "user".
 *
 * @property integer $id User unique code
 * @property string $name User full name
 * @property string $email User email address
 * @property string $username Username of the user
 * @property string $password Password of the user
 * @property string $can_config Indicate if the user can configure the application
 * @property string $salt Password SALT of the user
 * @property string $status Status of the record
 * @property datetime $date_created Date of the user was created
 * @property datetime $date_updated Date of the last updated
 * @property integer $user_created User that created the record
 * @property integer $user_updated User of the last updated of the record
 *
 * @property UserAccess[] $userAccess Access of the user through the system
 * @property User $user_created_data User object
 * @property User $user_updated_data User object
 * @property Department[] $departmentUserCreated Departments objects that user has created
 * @property Department[] $departmentUserUpdated Departments objects that user has updated
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

    const STATUS_ACTIVE = "A";
    const STATUS_INACTIVE = "I";
    const CONFIG_YES = "Y";
    const CONFIG_NO = "N";

    /**
     * Attribute used to compare passwords.
     *
     * @var string
     */
    public $new_password;


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
            [['name', 'username', 'email', 'can_config', 'status'], 'required'],
            [['username', 'email'], 'unique'],
            [['email'], 'email'],
            [['password', 'new_password'], 'required', 'on' => 'create'],
            [['new_password'], 'compare', 'compareAttribute' => 'password', 'message' => 'As senhas informadas não são iguais.'],
            [['password', 'date_created', 'date_updated', 'user_created', 'user_updated', 'salt'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['password'], 'string', 'min' => 6],
            [['email', 'username'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Código',
            'name' => 'Nome completo',
            'email' => 'E-mail',
            'can_config' => 'Pode acessar as configurações',
            'username' => 'Usuário de acesso',
            'password' => 'Senha de acesso',
            'new_password' => 'Repita a senha de acesso',
            'salt' => 'SALT',
            'status' => 'Estado',
            'date_created' => 'Data da criação',
            'date_updated' => 'Data da última atualização',
            'user_created' => 'Usuário que criou',
            'user_updated' => 'Usuário da última atualização',
            'usercreated.name' => 'Usuário que criou',
            'userupdated.name' => 'Usuário da última atualização',
        ];
    }

    /**
     * Return the access of the user through the system.
     *
     * @return ActiveQuery
     */
    public function getUserAccess()
    {
        return $this->hasMany(UserAccess::className(), ['user_id' => 'id']);
    }

    /**
     * Return all the departments that user has created.
     *
     * @return ActiveQuery
     */
    public function getDepartmentUserCreated()
    {
        return $this->hasMany(Department::className(), ['user_created' => 'id']);
    }

    /**
     * Return all the departments that user has updated.
     *
     * @return ActiveQuery
     */
    public function getDepartmentUserUpdated()
    {
        return $this->hasMany(Department::className(), ['user_updated' => 'id']);
    }

    /**
     * Do the password cryptography.
     *
     * @param $password Password
     * @param $key Password Key
     * @return string
     */
    private function passwordCrypt($password, $key)
    {
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
        return User::findOne(['status' => User::STATUS_ACTIVE, 'id' => $id]);
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
        return $this->id;
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

    /**
     * Store the connection log of the user.
     *
     * @param String $type Type of the connection
     */
    public function storeLog($type)
    {
        $log = new UserAccess();
        $log->user_id = $this->id;
        $log->type = $type;
        $log->date = new Expression('current_timestamp');
        $log->ip = Yii::$app->getRequest()->getUserIP();
        $log->save(false);
    }

    /**
     * @inheritdoc
     */
    public function beforeDelete()
    {
        if (parent::beforeDelete())
        {
            return ($this->id !== 1);
        }
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if ($insert)
        {
            $this->date_created = new Expression('current_timestamp');
            $this->user_created = Yii::$app->getUser()->getId();
            $this->salt = Yii::$app->getSecurity()->generatePasswordHash($this->password);
        }

        $this->date_updated = new Expression('current_timestamp');
        $this->user_updated = Yii::$app->getUser()->getId();

        if ($this->password != '')
        {
            $this->salt = Yii::$app->getSecurity()->generatePasswordHash($this->password);
            $this->password = $this->passwordCrypt($this->password, $this->salt);
        } else
        {
            $user = self::findOne($this->id);
            if ($user)
            {
                $this->password = $user->password;
            }
        }

        return parent::beforeSave($insert);
    }

    /**
     * Returns the information about the user that created the record.
     *
     * @return User
     */
    public function getUserCreated()
    {
        return $this->findOne(['id' => $this->user_created]);
    }

    /**
     * Returns the information about the user of the last record updated.
     *
     * @return User
     */
    public function getUserUpdated()
    {
        return $this->findOne(['id' => $this->user_updated]);
    }

    /**
     * Delete all the access information about the user.
     * Returns the number of rows deleted.
     *
     * @return int
     */
    public function clearAccessInformation()
    {
        return UserAccess::deleteAll(['id' => $this->getId()]);
    }

    /**
     * Returns if the user can access the configuration pages.
     *
     * @return bool
     */
    public function getIsCanConfig()
    {
        return $this->can_config == self::CONFIG_YES;
    }

    /**
     * Returns the status description of the user.
     *
     * @return string
     */
    public function getStatus()
    {
        return ($this->status != '') ? self::getStatusData()[$this->status] : '';
    }

    /**
     * Returns the can config description of the user.
     *
     * @return string
     */
    public function getCanConfig()
    {
        return ($this->can_config != '') ? self::getCanConfigData()[$this->can_config] : '';
    }

    /**
     * Returns all the user status information.
     *
     * @return array
     */
    public static function getStatusData()
    {
        return [
            self::STATUS_ACTIVE => "Ativo",
            self::STATUS_INACTIVE => "Inativo"
        ];
    }

    /**
     * Returns all the config options.
     *
     * @return array
     */
    public static function getCanConfigData()
    {
        return [
            self::CONFIG_YES => 'Sim',
            self::CONFIG_NO => 'Não'
        ];
    }
}

