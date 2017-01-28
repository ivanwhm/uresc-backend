<?php
/**
 * This is the model class for table "settings".
 *
 * @property integer $id Settings' ID.
 * @property string $phrase Phrase that will be presented in header page.
 * @property string $phrase_author Author of the phrase that will be presented in header page.
 * @property string $page_title Title of the main page.
 * @property datetime $date_updated Settings' date of updated.
 * @property integer $user_updated Settings' user updated.
 *
 * @property User $userUpdated User that updated the calendar.
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */
namespace app\models;

//Imports
use app\components\UreActiveRecord;
use Yii;

class Settings extends UreActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_updated', 'user_updated'], 'safe'],
            [['phrase', 'phrase_author', 'page_title', 'phone_mask'], 'required'],
            [['user_updated'], 'integer'],
            [['phrase'], 'string', 'max' => 255],
            [['phrase_author', 'page_title'], 'string', 'max' => 150],
            [['user_updated'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_updated' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('settings', 'ID'),
            'phrase' => Yii::t('settings', 'Main phrase'),
            'phrase_author' => Yii::t('settings', 'Main phase author'),
            'page_title' => Yii::t('settings', 'Main page title'),
            'phone_mask' => Yii::t('settings', 'Phone mask'),
            'date_updated' => Yii::t('general', 'Date of the update'),
            'user_updated' => Yii::t('general', 'User who do last update'),
            'userupdated.name' => Yii::t('general', 'User who do last update'),
        ];
    }

}
