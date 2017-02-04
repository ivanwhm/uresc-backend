<?php
use app\models\Gallery;
use app\models\User;

/**
 * This is the model class for table "gallery_files".
 *
 * @property integer $id File's ID.
 * @property integer $gallery_id Gallery ID of the file.
 * @property string $filename Complete filename of the file.
 * @property string $address Url to something.
 * @property datetime $date_created File's date of creation.
 * @property datetime $date_updated File's date of updated.
 * @property integer $user_created File's user created.
 * @property integer $user_updated File's user updated.
 *
 * @property User $userCreated User that created the files.
 * @property User $userUpdated User that updated the files.
 * @property Gallery $gallery Gallery of the files.
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */
namespace app\models;

//Imports
use app\components\UreActiveRecord;
use Exception;
use Yii;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class GalleryFiles extends UreActiveRecord
{

    /**
     * Cover to be uploaded.
     *
     * @var UploadedFile
     */
    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gallery_files';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['address'], 'required', 'on' => 'link'],
            [['gallery_id', 'user_created', 'user_updated'], 'integer'],
            [['address'], 'url'],
            [['gallery_id', 'filename', 'user_created', 'user_updated', 'date_created', 'date_updated'], 'safe'],
            [['filename'], 'string', 'max' => 150],
            [['address'], 'string', 'max' => 255],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpeg, jpg, png', 'maxFiles' => 1],
            [['gallery_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gallery::className(), 'targetAttribute' => ['gallery_id' => 'id']],
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
            'gallery_id' => Yii::t('gallery', 'Gallery ID'),
            'filename' => Yii::t('gallery', 'Filename'),
            'address' => Yii::t('gallery', 'Address'),
            'file' => Yii::t('gallery', 'Cover'),
            'date_created' => Yii::t('general', 'Date of creation'),
            'date_updated' => Yii::t('general', 'Date of the update'),
            'user_created' => Yii::t('general', 'User who created'),
            'user_updated' => Yii::t('general', 'User who do last update'),
        ];
    }

    /**
     * Returns the file's gallery.
     *
     * @return Gallery
     */
    public function getGallery()
    {
        return Gallery::findOne(['id' => $this->gallery_id]);
    }



    /**
     * Do the logo file upload.
     *
     * @return bool
     */
    public function upload()
    {
        if ($this->validate())
        {
            if ($this->file instanceof UploadedFile)
            {
                try
                {
                    $this->filename = Yii::$app->getSecurity()->generateRandomString() . '.' . $this->file->extension;
                    $directory = $this->getGallery()->getGalleryDirectory();

                    if (FileHelper::createDirectory($directory))
                    {
                        $this->file->saveAs($directory . $this->filename );
                        $this->file = null;
                    } else
                    {
                        $this->addError('file', Yii::t('gallery', 'It is not possible to upload files now. Please, try again later.'));
                        return false;
                    }
                } catch (Exception $e)
                {
                    $this->addError('file', Yii::t('gallery', 'It is not possible to upload files now. Please, try again later.'));
                    return false;
                }
            } elseif ($this->getIsNewRecord())
            {
                $this->addError('file', Yii::t('yii', '{attribute} cannot be blank.', [
                    'attribute' => $this->getAttributeLabel('file')
                ]));
                return false;
            }
        }
        return true;
    }

}
