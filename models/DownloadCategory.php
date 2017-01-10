<?php
/**
 * This is the model class for table "download_category".
 *
 * @property integer $id Download category's unique ID.
 * @property string $name Download category's name
 * @property string $status Download category's status.
 * @property string $date_created Download category's date of creation.
 * @property string $date_updated Download category's date of updated.
 * @property integer $user_created Download category's user created.
 * @property integer $user_updated Download category's user updated.
 *
 * @property User $userCreated User that created the download category.
 * @property User $userUpdated User that updated the download category.
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

namespace app\models;

//Imports
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\db\Expression;

class DownloadCategory extends ActiveRecord
{

    const STATUS_ACTIVE = "A";
    const STATUS_INACTIVE = "I";

    /**
     * Returns all the download category status.
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
        return 'download_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'status'], 'required'],
            [['date_created', 'date_updated', 'user_created', 'user_updated'], 'safe'],
            [['user_created', 'user_updated'], 'integer'],
            [['name'], 'string', 'max' => 59],
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
            'date_created' => 'Data da criação',
            'date_updated' => 'Data da última atualização',
            'user_created' => 'Usuário que criou',
            'user_updated' => 'Usuário da última atualização',
            'usercreated.name' => 'Usuário que criou',
            'userupdated.name' => 'Usuário da última atualização',
        ];
    }

    /**
     * Returns the user that created the download category.
     *
     * @return ActiveQuery
     */
    public function getUserCreated()
    {
        return User::findOne(['id' => $this->user_created]);
    }

    /**
     * Returns the user that updated the download category.
     *
     * @return ActiveQuery
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
     * @return array
     */
    public static function getDownloadCategories()
    {
        $all = [];
        $categories = self::find(['status' => self::STATUS_ACTIVE])->orderBy('name')->all();
        foreach ($categories as $category)
        {
            $all[$category->id] = $category->name;
        }
        return $all;
    }

    /**
     * Return the description of download category status.
     *
     * @return string
     */
    public function getStatus()
    {
        return ($this->status != '') ? self::$statusData[$this->status] : '';
    }
}
