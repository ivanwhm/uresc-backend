<?php
/**
 * This is the model class for table "user".
 *
 * @property integer $id User unique code
 * @property string $name User full name
 * @property string $email User email address
 * @property string $password Password of the user
 * @property string $can_access_settings Indicate if the user can configure the application
 * @property string $language System language of the user
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
use app\components\UreActiveRecord;
use kartik\password\StrengthValidator;
use Yii;
use yii\db\ActiveQuery;
use yii\db\Expression;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\IdentityInterface;

class User extends UreActiveRecord implements IdentityInterface
{

    const STATUS_ACTIVE = "A";
    const STATUS_INACTIVE = "I";

    const SETTINGS_YES = "Y";
    const SETTINGS_NO = "N";

    const LANGUAGE_PT_BR = 'pt-BR';
    const LANGUAGE_EN_US = 'en-US';

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
            [['name', 'email', 'can_access_settings', 'language', 'status'], 'required'],
            [['email'], 'unique'],
            [['email'], 'email'],
            [['password', 'new_password'], 'required', 'on' => 'create'],
            [['password', 'new_password'], StrengthValidator::className(), 'hasUser' => false, 'hasEmail' => false, 'min' => 6, 'max' => 30, 'lower' => 1, 'upper' => 1, 'digit' => 1, 'special' => 1],
            [['new_password'], 'compare', 'compareAttribute' => 'password', 'message' => Yii::t('password', 'The entered passwords are differents.')],
            [['password', 'date_created', 'date_updated', 'user_created', 'user_updated', 'salt'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['password'], 'string', 'min' => 6],
            [['language'], 'string', 'max' => 5],
            [['email'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('user', 'ID'),
            'name' => Yii::t('user', 'Name'),
            'email' => Yii::t('user', 'E-mail'),
            'can_access_settings' => Yii::t('user', 'Can access the settings?'),
            'language' => Yii::t('user', 'Language'),
            'password' => Yii::t('user', 'Password'),
            'new_password' => Yii::t('user', 'Password (again)'),
            'salt' => 'SALT',
            'status' => Yii::t('general', 'Status'),
            'date_created' => Yii::t('general', 'Date of creation'),
            'date_updated' => Yii::t('general', 'Date of the update'),
            'user_created' => Yii::t('general', 'User who created'),
            'user_updated' => Yii::t('general', 'User who do last update'),
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
        $log->session_id = Yii::$app->getSession()->getId();
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
            $this->salt = Yii::$app->getSecurity()->generateRandomString(64);
        }

        if ($this->password != '')
        {
            $this->salt = Yii::$app->getSecurity()->generateRandomString(64);
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
     * Returns if the user can access the settings pages.
     *
     * @return bool
     */
    public function getIsCanAccessSettings()
    {
        return $this->can_access_settings == self::SETTINGS_YES;
    }

    /**
     * Returns the status description of the user.
     *
     * @return string
     */
    public function getStatus()
    {
        return ($this->status != '') ? $result = Html::tag('span', Html::tag('i', '', ['class' => 'glyphicon ' . (($this->status == self::STATUS_ACTIVE) ? 'glyphicon-ok' : 'glyphicon-remove')]) . '  ' . self::getStatusData()[$this->status], ['class' => 'label ' . (($this->status == self::STATUS_ACTIVE) ? 'label-primary' : 'label-danger')]) : '';;
    }

    /**
     * Returns the can access settings description of the user.
     *
     * @return string
     */
    public function getCanAccessSettings()
    {
        return ($this->can_access_settings != '') ? $result = Html::tag('span', Html::tag('i', '', ['class' => 'glyphicon ' . (($this->can_access_settings == self::SETTINGS_YES) ? 'glyphicon-ok' : 'glyphicon-remove')]) . '  ' . self::getCanAccessSettingsData()[$this->can_access_settings], ['class' => 'label ' . (($this->can_access_settings == self::SETTINGS_YES) ? 'label-primary' : 'label-danger')]) : '';;
    }

    /**
     * Returns the language description of the user.
     *
     * @return string
     */
    public function getLanguage()
    {
        return ($this->language != '') ? self::getLanguageData()[$this->language] : '';
    }

    /**
     * Returns all the user status information.
     *
     * @return array
     */
    public static function getStatusData()
    {
        return [
            self::STATUS_ACTIVE => Yii::t('general', 'Active'),
            self::STATUS_INACTIVE => Yii::t('general', 'Inactive')
        ];
    }

    /**
     * Returns all the can access settings options.
     *
     * @return array
     */
    public static function getCanAccessSettingsData()
    {
        return [
            self::SETTINGS_YES => Yii::t('general', 'Yes'),
            self::SETTINGS_NO => Yii::t('general', 'No')
        ];
    }

    /**
     * Returns all the languages options.
     *
     * @return array
     */
    public static function getLanguageData()
    {
        return [
            self::LANGUAGE_EN_US => Yii::t('general', 'English (United States)'),
            self::LANGUAGE_PT_BR => Yii::t('general', 'Portuguese (Brazil)')
        ];
    }

    /**
     * Returns the link to user visualization info.
     *
     * @return string
     */
    public function getLink()
    {
        return Url::to(['user/view', 'id' => $this->id]);
    }

}

