<?php
/**
 * This is the model class for table "department".
 *
 * @property integer $id Department' unique ID.
 * @property string $name Department's name
 * @property string $status Department's status.
 * @property string $info Department's text.
 * @property datetime $date_created Department's date of creation.
 * @property datetime $date_updated Department's date of updated.
 * @property integer $user_created Department's user created.
 * @property integer $user_updated Department's user updated.
 *
 * @property User $userCreated User that created the department.
 * @property User $userUpdated User that updated the department.
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

namespace app\models;

//Imports
use app\components\UreActiveRecord;
use Yii;
use yii\helpers\Html;

class Department extends UreActiveRecord
{

    const STATUS_ACTIVE = "A";
    const STATUS_INACTIVE = "I";

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'department';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'status'], 'required'],
            [['info'], 'string'],
            [['id', 'date_created', 'date_updated', 'user_created', 'user_updated'], 'safe'],
            [['user_created', 'user_updated'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['status'], 'string', 'max' => 1],
            [['user_created'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_created' => 'id']],
            [['user_updated'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_updated' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('department', 'ID'),
            'name' => Yii::t('department', 'Name'),
            'status' => Yii::t('general', 'Status'),
            'info' => Yii::t('department', 'Text'),
            'date_created' => Yii::t('general', 'Date of creation'),
            'date_updated' => Yii::t('general', 'Date of the update'),
            'user_created' => Yii::t('general', 'User who created'),
            'user_updated' => Yii::t('general', 'User who do last update'),
        ];
    }

    /**
     * @return Department[]
     */
    public static function getDepartments()
    {
        return self::find([
            'status' => self::STATUS_ACTIVE
        ])->orderBy('name')->all();
    }

    /**
     * Returns all the department status information.
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
     * Return the description of department status.
     *
     * @return string
     */
    public function getStatus()
    {
        return ($this->status != '') ? $result = Html::tag('span', Html::tag('i', '', ['class' => 'glyphicon ' . (($this->status == self::STATUS_ACTIVE) ? 'glyphicon-ok' : 'glyphicon-remove')]) . '  ' . self::getStatusData()[$this->status], ['class' => 'label ' . (($this->status == self::STATUS_ACTIVE) ? 'label-primary' : 'label-danger')]) : '';
    }

}
