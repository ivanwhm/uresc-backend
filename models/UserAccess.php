<?php
/**
 * This is the model class for table "user_access".
 *
 * @property integer $user_access_id Unique code of user`s access
 * @property integer $user_id Unique code of user
 * @property datetime $date Date of connection
 * @property string $ip IP of user
 * @property string $type Type of the connection
 *
 * @property User $user User object
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

namespace app\models;

//Imports
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

class UserAccess extends ActiveRecord
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
            [['user_access_id', 'user_id'], 'required'],
            [['user_access_id', 'user_id'], 'integer'],
            [['date'], 'safe'],
            [['ip'], 'string', 'max' => 255],
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
            'date' => 'Date',
            'ip' => 'IP',
            'type' => 'Type',
        ];
    }

    /**
     * Returns the information about the user.
     *
     * @return User
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }


}
