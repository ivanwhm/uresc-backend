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
use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;

class Department extends ActiveRecord
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
            'id' => 'Código',
            'name' => 'Nome',
            'status' => 'Estado',
            'info' => 'Texto do departamento',
            'date_created' => 'Data da criação',
            'date_updated' => 'Data da última atualização',
            'user_created' => 'Usuário que criou',
            'user_updated' => 'Usuário da última atualização',
            'usercreated.name' => 'Usuário que criou',
            'userupdated.name' => 'Usuário da última atualização',
        ];
    }

    /**
     * Returns the user that created the department.
     *
     * @return User
     */
    public function getUserCreated()
    {
        return User::findOne(['id' => $this->user_created]);
    }

    /**
     * Returns the user that updated the department.
     *
     * @return User
     */
    public function getUserUpdated()
    {
        return User::findOne(['id' => $this->user_updated]);
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
        }

        $this->date_updated = new Expression('current_timestamp');
        $this->user_updated = Yii::$app->getUser()->getId();

        return parent::beforeSave($insert);
    }

    /**
     * @return Department[]
     */
    public static function getDepartments()
    {
        return self::find(['status' => self::STATUS_ACTIVE])->orderBy('name')->all();
    }

    /**
     * Returns all the department status information.
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
     * Return the description of department status.
     *
     * @return string
     */
    public function getStatus()
    {
        return ($this->status != '') ? self::getStatusData()[$this->status] : '';
    }

    /**
     * Returns the created information to print on views.
     *
     * @return string
     */
    public function printCreatedInformation()
    {
        return 'Criado em ' . Yii::$app->getFormatter()->asDatetime($this->date_created) . ' por ' . $this->getUserCreated()->getName() . '.';
    }

    /**
     * Returns the last updated information to print on views.
     *
     * @return string
     */
    public function printLastUpdatedInformation()
    {
        return 'Última alteração em ' . Yii::$app->getFormatter()->asDatetime($this->date_updated) . ' por ' . $this->getUserUpdated()->getName() . '.';
    }
}
