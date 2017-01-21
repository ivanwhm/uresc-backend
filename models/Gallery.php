<?php
/**
 * This is the model class for table "gallery".
 *
 * @property integer $id Gallery's ID.
 * @property string $name Gallery' name.
 * @property integer $category_id Gallery's category.
 * @property string $address Gallery's file address.
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
use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\Html;

class Gallery extends ActiveRecord
{

    const STATUS_ACTIVE = "A";
    const STATUS_INACTIVE = "I";

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
            'id' => Yii::t('gallery', 'ID'),
            'name' => Yii::t('gallery', 'Name'),
            'category_id' => Yii::t('gallery', 'Category'),
            'category.name' => Yii::t('gallery', 'Category'),
            'address' => Yii::t('gallery', 'File address'),
            'status' => Yii::t('general', 'Status'),
            'date_created' => Yii::t('general', 'Date of creation'),
            'date_updated' => Yii::t('general', 'Date of the update'),
            'user_created' => Yii::t('general', 'User who created'),
            'user_updated' => Yii::t('general', 'User who do last update'),
            'usercreated.name' => Yii::t('general', 'User who created'),
            'userupdated.name' => Yii::t('general', 'User who do last update'),
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
}
