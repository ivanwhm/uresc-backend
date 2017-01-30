<?php
/**
 * This is the model class for table "page".
 *
 * @property integer $id Page's ID.
 * @property string $name Page's name.
 * @property string $icon Icon to represent page.
 * @property string $text Page's text.
 * @property datetime $date_created Page's date of creation.
 * @property datetime $date_updated Page's date of updated.
 * @property integer $user_created Page's user created.
 * @property integer $user_updated Page's user updated.
 *
 * @property User $userCreated User that created the center.
 * @property User $userUpdated User that updated the center.
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */
namespace app\models;

//Imports
use app\components\UreActiveRecord;
use Yii;
use yii\helpers\Url;

class Page extends UreActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['text'], 'required', 'on' => 'info'],
            [['text', 'icon'], 'string'],
            [['user_created', 'user_updated', 'date_created', 'date_updated'], 'safe'],
            [['user_created', 'user_updated'], 'integer'],
            [['name'], 'string', 'max' => 150],
            [['icon'], 'string', 'max' => 50],
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
            'id' => Yii::t('page', 'ID'),
            'name' => Yii::t('page', 'Name'),
            'icon' => Yii::t('page', 'Icon'),
            'text' => Yii::t('page', 'Text'),
            'date_created' => Yii::t('general', 'Date of creation'),
            'date_updated' => Yii::t('general', 'Date of the update'),
            'user_created' => Yii::t('general', 'User who created'),
            'user_updated' => Yii::t('general', 'User who do last update'),
        ];
    }

    /**
     * Return all the pages.
     *
     * @return Page[]
     */
    public static function getPages()
    {
        return self::find()->orderBy('name')->all();
    }

    /**
     * Returns the link to page info.
     *
     * @return string
     */
    public function getLink()
    {
        return Url::to(['page/info', 'id' => $this->id]);
    }

}
