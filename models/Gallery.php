<?php
/**
 * This is the model class for table "gallery".
 *
 * @property integer $id Gallery's ID.
 * @property string $name Gallery' name.
 * @property integer $category_id Gallery's category.
 * @property string $address Gallery's file address.
 * @property string $status Gallery's status.
 * @property string $date_created Gallery's date of creation.
 * @property string $date_updated Gallery's date of updated.
 * @property integer $user_created Gallery's user created.
 * @property integer $user_updated Gallery's user updated.
 *
 * @property GalleryCategory $category GalleryCategory of the gallery record.
 * @property User $userCreated User that created the gallery.
 * @property User $userUpdated User that updated the gallery.
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */
namespace app\models;

//Imports
use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;

class Gallery extends ActiveRecord
{
    const STATUS_ACTIVE = "A";
    const STATUS_INACTIVE = "I";

    /**
     * Returns all the gallery status.
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
        return 'gallery';
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
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => GalleryCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
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
            'category_id' => 'Categoria',
            'category.name' => 'Categoria',
            'address' => 'Endereço do arquivo',
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
     * Return the gallery's category.
     *
     * @return GalleryCategory
     */
    public function getCategory()
    {
        return GalleryCategory::findOne(['id' => $this->category_id]);
    }

    /**
     * Returns the user that created the gallery category.
     *
     * @return User
     */
    public function getUserCreated()
    {
        return User::findOne(['id' => $this->user_created]);
    }

    /**
     * Returns the user that updated the gallery category.
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
        if ($insert) {
            $this->date_created = new Expression('current_timestamp');
            $this->user_created = Yii::$app->getUser()->getId();
        }

        $this->date_updated = new Expression('current_timestamp');
        $this->user_updated = Yii::$app->getUser()->getId();

        return parent::beforeSave($insert);
    }

    /**
     * Return the description of gallery status.
     *
     * @return string
     */
    public function getStatus()
    {
        return ($this->status != '') ? self::$statusData[$this->status] : '';
    }

}
