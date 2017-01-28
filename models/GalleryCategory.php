<?php
/**
 * This is the model class for table "gallery_category".
 *
 * @property integer $id Gallery category's unique ID.
 * @property string $name Gallery category's name
 * @property string $status Gallery category's status.
 * @property datetime $date_created Gallery category's date of creation.
 * @property datetime $date_updated Gallery category's date of updated.
 * @property integer $user_created Gallery category's user created.
 * @property integer $user_updated Gallery category's user updated.
 *
 * @property User $userCreated User that created the gallery category.
 * @property User $userUpdated User that updated the gallery category.
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */
namespace app\models;

//Imports
use app\components\UreActiveRecord;
use Yii;
use yii\helpers\Html;

class GalleryCategory extends UreActiveRecord
{

    const STATUS_ACTIVE = "A";
    const STATUS_INACTIVE = "I";
    const ONLY_PICTURE_YES = 'Y';
    const ONLY_PICTURE_NO = 'N';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gallery_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_created', 'user_updated', 'date_created', 'date_updated'], 'safe'],
            [['name', 'status'], 'required'],
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
            'id' => Yii::t('gallery_category', 'ID'),
            'name' => Yii::t('gallery_category', 'Name'),
            'status' => Yii::t('general', 'Status'),
            'date_created' => Yii::t('general', 'Date of creation'),
            'date_updated' => Yii::t('general', 'Date of the update'),
            'user_created' => Yii::t('general', 'User who created'),
            'user_updated' => Yii::t('general', 'User who do last update'),
        ];
    }

    /**
     * Returns all the gallery categories.
     *
     * @return array
     */
    public static function getGalleryCategories()
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
     * Returns all the gallery category status.
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
     * Returns the description of gallery category status.
     *
     * @return string
     */
    public function getStatus()
    {
        return ($this->status != '') ? $result = Html::tag('span', Html::tag('i', '', ['class' => 'glyphicon ' . (($this->status == self::STATUS_ACTIVE) ? 'glyphicon-ok' : 'glyphicon-remove')]) . '  ' . self::getStatusData()[$this->status], ['class' => 'label ' . (($this->status == self::STATUS_ACTIVE) ? 'label-primary' : 'label-danger')]) : '';
    }

}
