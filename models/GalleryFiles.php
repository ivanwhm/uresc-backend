<?php
/**
 * This is the model class for table "gallery_files".
 *
 * @property integer $id File's ID.
 * @property integer $gallery_id Gallery ID of the file.
 * @property string $filename Complete filename of the file.
 * @property string $cover This is a cover file of the gallery?
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
use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;

class GalleryFiles extends ActiveRecord
{

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
            [['gallery_id', 'filename'], 'required'],
            [['gallery_id', 'user_created', 'user_updated'], 'integer'],
            [['user_created', 'user_updated', 'date_created', 'date_updated'], 'safe'],
            [['filename'], 'string', 'max' => 150],
            [['cover'], 'string', 'max' => 1],
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
            'cover' => Yii::t('gallery', 'Cover'),
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
     * Returns the user that created the file.
     *
     * @return User
     */
    public function getUserCreated()
    {
        return User::findOne(['id' => $this->user_created]);
    }

    /**
     * Returns the user that updated the file.
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

}
