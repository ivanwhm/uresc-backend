<?php
/**
 * This is the model class for table "news".
 *
 * @property integer $id News' ID.
 * @property string $title News' Title
 * @property string $text News
 * @property string $published Shows if news is published.
 * @property datetime $date_created Events's date of creation.
 * @property datetime $date_updated Events's date of updated.
 * @property integer $user_created Events's user created.
 * @property integer $user_updated Events's user updated.
 *
 * @property User $userCreated User that created the news.
 * @property User $userUpdated User that updated the news.
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */
namespace app\models;

//Imports
use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;

class News extends ActiveRecord
{

    const PUBLISHED_YES = "Y";
    const PUBLISHED_NO = "N";

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'text'], 'required'],
            [['text'], 'string'],
            [['user_created', 'user_updated', 'date_created', 'date_updated'], 'safe'],
            [['user_created', 'user_updated'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['published'], 'string', 'max' => 1],
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
            'id' => Yii::t('news', 'ID'),
            'title' => Yii::t('news', 'Title'),
            'text' => Yii::t('news', 'Text'),
            'published' => Yii::t('news', 'Published'),
            'date_created' => Yii::t('general', 'Date of creation'),
            'date_updated' => Yii::t('general', 'Date of the update'),
            'user_created' => Yii::t('general', 'User who created'),
            'user_updated' => Yii::t('general', 'User who do last update'),
            'usercreated.name' => Yii::t('general', 'User who created'),
            'userupdated.name' => Yii::t('general', 'User who do last update'),
        ];
    }

    /**
     * Returns the user that created the news.
     *
     * @return User
     */
    public function getUserCreated()
    {
        return User::findOne(['id' => $this->user_created]);
    }

    /**
     * Returns the user that updated the news.
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
     * Returns all the unpublished news.
     *
     * @return integer
     */
    public static function getUnpublishedNews()
    {
        return self::find(['published' => self::PUBLISHED_NO])->count();
    }

    /**
     * Returns all the published options.
     *
     * @return array
     */
    public static function getPublishedData()
    {
        return [
            self::PUBLISHED_YES => Yii::t('general', 'Yes'),
            self::PUBLISHED_NO => Yii::t('general', 'No')
        ];
    }

    /**
     * Return the published description of the news.
     *
     * @return string
     */
    public function getPublished()
    {
        return ($this->published != '') ? self::getPublishedData()[$this->published] : '';
    }

    /**
     * Return if the news was published.
     *
     * @return bool
     */
    public function getIsPublished()
    {
        return $this->published == self::PUBLISHED_YES;
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
