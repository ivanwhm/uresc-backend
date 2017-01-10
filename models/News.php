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
            'id' => 'Código',
            'title' => 'Título',
            'text' => 'Texto',
            'published' => 'Publicado',
            'date_created' => 'Data da criação',
            'date_updated' => 'Data da última atualização',
            'user_created' => 'Usuário que criou',
            'user_updated' => 'Usuário da última atualização',
            'usercreated.name' => 'Usuário que criou',
            'userupdated.name' => 'Usuário da última atualização',
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
            self::PUBLISHED_YES => "Sim",
            self::PUBLISHED_NO => "Não"
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
}
