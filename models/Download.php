<?php
/**
 * This is the model class for table "download".
 *
 * @property integer $id Downloads's ID.
 * @property string $name Download' name.
 * @property integer $category_id Download's category.
 * @property string $address Download's file address.
 * @property string $cover_filename Download's cover filename.
 * @property string $status Download's status.
 * @property datetime $date_created Download's date of creation.
 * @property datetime $date_updated Download's date of updated.
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
use app\components\UreActiveRecord;
use Exception;
use Yii;
use yii\helpers\FileHelper;
use yii\helpers\Html;
use yii\web\UploadedFile;

class Download extends UreActiveRecord
{
    const STATUS_ACTIVE = "A";
    const STATUS_INACTIVE = "I";

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
        return 'download';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'category_id', 'address'], 'required'],
            [['date_created', 'date_updated', 'user_created', 'user_updated', 'cover_filename'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['address'], 'string', 'max' => 255],
            [['cover_filename'], 'string', 'max' => 150],
            [['address'], 'url'],
            [['status'], 'string', 'max' => 1],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpeg, jpg, png', 'maxFiles' => 1],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => DownloadCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
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
            'id' => Yii::t('download', 'ID'),
            'name' => Yii::t('download', 'Name'),
            'category_id' => Yii::t('download', 'Category'),
            'address' => Yii::t('download', 'Download address'),
            'cover_filename' => Yii::t('download', 'Cover'),
            'file' => Yii::t('download', 'Cover'),
            'status' => Yii::t('general', 'Status'),
            'date_created' => Yii::t('general', 'Date of creation'),
            'date_updated' => Yii::t('general', 'Date of the update'),
            'user_created' => Yii::t('general', 'User who created'),
            'user_updated' => Yii::t('general', 'User who do last update'),
        ];
    }

    /**
     * Return the download categories model.
     *
     * @return DownloadCategory
     */
    public function getCategory()
    {
        return DownloadCategory::findOne(['id' => $this->category_id]);
    }

    /**
     * Returns all the download status information.
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
     * Return the description of download status.
     *
     * @return string
     */
    public function getStatus()
    {
        return ($this->status != '') ? $result = Html::tag('span', Html::tag('i', '', ['class' => 'glyphicon ' . (($this->status == self::STATUS_ACTIVE) ? 'glyphicon-ok' : 'glyphicon-remove')]) . '  ' . self::getStatusData()[$this->status], ['class' => 'label ' . (($this->status == self::STATUS_ACTIVE) ? 'label-primary' : 'label-danger')]) : '';
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
                    $this->cover_filename = Yii::$app->getSecurity()->generateRandomString() . '.' . $this->file->extension;
                    $directory = $this->getCoverDirectory();

                    if (FileHelper::createDirectory($directory))
                    {
                        $this->file->saveAs($directory . $this->cover_filename);
                        $this->file = null;
                    } else
                    {
                        $this->addError('file', Yii::t('download', 'It is not possible to upload cover image now. Please, try again later.'));
                        return false;
                    }
                } catch (Exception $e)
                {
                    $this->addError('file', Yii::t('download', 'It is not possible to upload cover image now. Please, try again later.'));
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

    /**
     * Returns the cover image directory.
     *
     * @return string
     */
    public function getCoverDirectory()
    {
        return Yii::getAlias('@app') . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'download' . DIRECTORY_SEPARATOR;
    }
}
