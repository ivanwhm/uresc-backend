<?php
/**
 * This is the model class for table "user_access".
 *
 * @property integer $user_access_id Unique code of user`s access
 * @property integer $user_id Unique code of user
 * @property datetime $date Date of connection
 * @property string $session_id The session ID of the user.
 * @property string $ip IP of user
 * @property string $type Type of the connection
 *
 * @property User $user User object
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

namespace app\models;

//Imports
use app\components\UreActiveRecord;
use Yii;
use yii\helpers\Html;

class UserAccess extends UreActiveRecord
{

    const TYPE_CONNECTION = 'C';
    const TYPE_DISCONNECTION = 'D';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_access';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_access_id', 'user_id', 'session_id'], 'required'],
            [['user_access_id', 'user_id'], 'integer'],
            [['date'], 'safe'],
            [['ip'], 'string', 'max' => 255],
            [['session_id'], 'string', 'max' => 128],
            [['type'], 'string', 'max' => 1],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_access_id' => 'User Access ID',
            'user_id' => 'User ID',
            'session_id' => 'Session ID',
            'date' => Yii::t('user', 'Access date'),
            'ip' => Yii::t('user', 'IP access'),
            'type' => Yii::t('user', 'Connection type'),
        ];
    }

    /**
     * Returns the information about the user.
     *
     * @return User
     */
    public function getUser()
    {
        return $this->findOne(['id' => $this->user_id]);
    }

    /**
     * Returns all the user type information.
     *
     * @return array
     */
    public static function getTypeData()
    {
        return [
            self::TYPE_CONNECTION => Yii::t('user', 'Connection'),
            self::TYPE_DISCONNECTION => Yii::t('user', 'Disconnection')
        ];
    }

    /**
     * Returns the type description of the user.
     *
     * @return string
     */
    public function getType()
    {
        return ($this->type != '') ? $result = Html::tag('span', Html::tag('i', '', ['class' => 'glyphicon ' . (($this->type == self::TYPE_CONNECTION) ? 'glyphicon-ok' : 'glyphicon-remove')]) . '  ' . self::getTypeData()[$this->type], ['class' => 'label ' . (($this->type == self::TYPE_CONNECTION) ? 'label-primary' : 'label-danger')]) : '';;
    }

}
