<?php
/**
 * This is the model class for table "news".
 *
 * @property integer $id News' ID.
 * @property string $title News' Title
 * @property string $text News
 * @property string $published Shows if news is published.
 * @property datetime $date_created News' date of creation.
 * @property datetime $date_updated News' date of updated.
 * @property integer $user_created News' user created.
 * @property integer $user_updated News' user updated.
 *
 * @property User $userCreated User that created the news.
 * @property User $userUpdated User that updated the news.
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */
namespace app\models;

//Imports
use app\components\UreActiveRecord;
use Yii;
use yii\helpers\Html;

class News extends UreActiveRecord
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
        ];
    }

    /**
     * Returns all the unpublished news.
     *
     * @return integer
     */
    public static function getUnpublishedNews()
    {
        return count(self::findAll(['published' => self::PUBLISHED_NO]));
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
        return ($this->published != '') ? $result = Html::tag('span', Html::tag('i', '', ['class' => 'glyphicon ' . (($this->published == self::PUBLISHED_YES) ? 'glyphicon-ok' : 'glyphicon-remove')]) . '  ' . self::getPublishedData()[$this->published], ['class' => 'label ' . (($this->published == self::PUBLISHED_YES) ? 'label-primary' : 'label-danger')]) : '';
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

}
