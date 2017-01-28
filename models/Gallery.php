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
use app\components\UreActiveRecord;
use Exception;
use Yii;
use yii\helpers\FileHelper;
use yii\helpers\Html;
use yii\web\UploadedFile;

class Gallery extends UreActiveRecord
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
