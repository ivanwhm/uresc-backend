<?php
/**
 * This is the model class for table "download".
 *
 * @property integer $id Downloads's ID.
 * @property string $name Download' name.
 * @property integer $category_id Download's category.
 * @property string $address Download's file address.
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
use Yii;
use yii\helpers\Html;

class Download extends UreActiveRecord
{
    const STATUS_ACTIVE = "A";
    const STATUS_INACTIVE = "I";

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

}
