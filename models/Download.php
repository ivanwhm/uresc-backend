<?php
/**
 * This is the model class for table "download".
 *
 * @property integer $id Downloads's ID.
 * @property string $name Download' name.
 * @property integer $category_id Download's category.
 * @property string $address Download's file address.
 * @property string $status Download's status.
 * @property string $date_created Download's date of creation.
 * @property string $date_updated Download's date of updated.
 * @property integer $user_created Download's user created.
 * @property integer $user_updated Download's user updated.
 *
 * @property DownloadCategory $category DownloadCategory of the download record.
 * @property User $userCreated User that created the download.
 * @property User $userUpdated User that updated the download.
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */
namespace app\models;

//Imports
use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;

class Download extends ActiveRecord
{
    const STATUS_ACTIVE = "A";
    const STATUS_INACTIVE = "I";

    /**
     * Returns all the download status.
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
        return 'download';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'category_id', 'address'], 'required'],
            [['date_created', 'date_updated', 'user_created', 'user_updated'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['address'], 'string', 'max' => 255],
            [['address'], 'url'],
            [['status'], 'string', 'max' => 1],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => DownloadCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
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
            'category_id' => 'Categoria',
            'address' => 'Endereço do arquivo',
            'status' => 'Estado',
            'date_created' => 'Data da criação',
            'date_updated' => 'Data da última atualização',
            'user_created' => 'Usuário que criou',
            'user_updated' => 'Usuário da última atualização'
        ];
    }

    /**
     * Return the download's category.
     *
     * @return DownloadCategory
     */
    public function getCategory()
    {
        return DownloadCategory::findOne(['id' => $this->category_id]);
    }

    /**
     * Returns the user that created the download category.
     *
     * @return User
     */
    public function getUserCreated()
    {
        return User::findOne(['user_id' => $this->user_created]);
    }

    /**
     * Returns the user that updated the download category.
     *
     * @return User
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