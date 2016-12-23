<?php
/**
 * This is the model class for table "department".
 *
 * @property integer $id Department' unique ID.
 * @property string $name Department's name
 * @property string $status Department's status.
 * @property string $info Department's text.
 * @property string $date_created Department's date of creation.
 * @property string $date_updated Department's date of updated.
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
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Expression;

class Department extends ActiveRecord
{

    const STATUS_ACTIVE = "A";
    const STATUS_INACTIVE = "I";

    /**
     * Returns all the user status.
     *
     * @var array
     */
    public static $statusData = [
        self::STATUS_ACTIVE => "Ativo",
        self::STATUS_INACTIVE => "Inativo"
    ];

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
            [['user_created'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_created' => 'user_id']],
            [['user_updated'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_updated' => 'user_id']],
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
            'info' => 'Informações',
            'date_created' => 'Data da criação',
            'date_updated' => 'Data da última atualização',
            'user_created' => 'Usuário que criou',
            'user_updated' => 'Usuário da última atualização'
        ];
    }

    /**
     * Returns the user that created the department.
     *
     * @return ActiveQuery
     */
    public function getUserCreated()
    {
        return User::findOne(['user_id' => $this->user_created]);
    }

    /**
     * Returns the user that updated the department.
     *
     * @return ActiveQuery
     */
    public function getUserUpdated()
    {
        return User::findOne(['user_id' => $this->user_updated]);
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

}
