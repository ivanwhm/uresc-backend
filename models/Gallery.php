<?php
/**
 * This is the model class for table "gallery".
 *
 * @property integer $id Gallery's ID.
 * @property string $name Gallery' name.
 * @property integer $category_id Gallery's category.
 * @property string $status Gallery's status.
 * @property datetime $date_created Gallery's date of creation.
 * @property datetime $date_updated Gallery's date of updated.
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
use Exception;
use Yii;
use yii\base\InvalidParamException;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\FileHelper;
use yii\helpers\Html;
use yii\web\UploadedFile;

class Gallery extends ActiveRecord
{

    const STATUS_ACTIVE = "A";
    const STATUS_INACTIVE = "I";

    /**
     * Files that will be upload.
     *
     * @var UploadedFile[]
     */
    public $files;

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
            [['name', 'category_id'], 'required'],
            [['date_created', 'date_updated', 'user_created', 'user_updated'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['status'], 'string', 'max' => 1],
            [['files'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpeg, jpg', 'maxFiles' => 10],
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
            'id' => Yii::t('gallery', 'ID'),
            'name' => Yii::t('gallery', 'Name'),
            'category_id' => Yii::t('gallery', 'Category'),
            'status' => Yii::t('general', 'Status'),
            'date_created' => Yii::t('general', 'Date of creation'),
            'date_updated' => Yii::t('general', 'Date of the update'),
            'user_created' => Yii::t('general', 'User who created'),
            'user_updated' => Yii::t('general', 'User who do last update'),
            'files' => Yii::t('gallery', 'Files')
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
        return ($this->status != '') ? $result = Html::tag('span', Html::tag('i', '', ['class' => 'glyphicon ' . (($this->status == self::STATUS_ACTIVE) ? 'glyphicon-ok' : 'glyphicon-remove')]) . '  ' . self::getStatusData()[$this->status], ['class' => 'label ' . (($this->status == self::STATUS_ACTIVE) ? 'label-primary' : 'label-danger')]) : '';
    }

    /**
     * Returns all the gallery status information.
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
     * Returns the created information to print on views.
     *
     * @return string
     */
    public function printCreatedInformation()
    {
        return Yii::t('general', 'Created on {date} by {username}.', [
            'date' => Yii::$app->getFormatter()->asDatetime($this->date_created),
            'username' => $this->getUserCreated()->getName()
        ]);
    }

    /**
     * Returns the last updated information to print on views.
     *
     * @return string
     */
    public function printLastUpdatedInformation()
    {
        return Yii::t('general', 'Last update on {date} by {username}.', [
            'date' => Yii::$app->getFormatter()->asDatetime($this->date_updated),
            'username' => $this->getUserUpdated()->getName()
        ]);
    }

    /**
     * Do the gallery's file upload.
     *
     * @return bool
     */
    public function upload()
    {
        if ($this->validate())
        {
            foreach ($this->files as $file)
            {
                $galleryFile = new GalleryFiles();
                $galleryFile->gallery_id = $this->id;
                $galleryFile->filename = Yii::$app->getSecurity()->generateRandomString() . '.' . $file->extension;

                try {
                    $directory =  $this->getGalleryDirectory();

                    if (FileHelper::createDirectory($directory))
                    {
                        if ($file->saveAs($directory . $galleryFile->filename))
                        {
                            $galleryFile->save(false);
                        }

                    } else
                    {
                        $this->addError('files', Yii::t('gallery', 'It is not possible to upload files now. Please, try again later.'));
                        return false;
                    }
                } catch (Exception $e)
                {
                    $this->addError('files', Yii::t('gallery', 'It is not possible to upload files now. Please, try again later.'));
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * Returns the gallery directory of the system.
     *
     * @return string
     */
    public function getGalleryDirectory()
    {
        return Yii::getAlias('@app') . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'gallery' . DIRECTORY_SEPARATOR. $this->id . DIRECTORY_SEPARATOR;
    }
}
