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
 * @property string $login_logo_image Imagem to be used on the login page.
 * @property string $default_business_hours The default business hours to new spiritist centres records.
 * @property string $language Default language to main page.
 *
 * @property User $userUpdated User that updated the calendar.
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */
namespace app\models;

//Imports
use app\components\UreActiveRecord;
use Exception;
use kartik\icons\Icon;
use Yii;
use yii\web\UploadedFile;

class Settings extends UreActiveRecord
{

    const LANGUAGE_PT_BR = 'pt-BR';
    const LANGUAGE_EN_US = 'en-US';

    /**
     * Files that will be upload.
     *
     * @var UploadedFile
     */
    public $logo;

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
            [['date_updated', 'user_updated', 'login_logo_image', 'logo', 'default_business_hours'], 'safe'],
            [['phrase', 'phrase_author', 'page_title', 'phone_mask', 'language'], 'required'],
            [['user_updated'], 'integer'],
            [['phrase'], 'string', 'max' => 255],
            [['default_business_hours'], 'string', 'max' => 100],
            [['phrase_author', 'page_title'], 'string', 'max' => 150],
            [['logo'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpeg, jpg, png', 'maxFiles' => 1],
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
            'logo' => Yii::t('settings', 'Login screen image'),
            'default_business_hours' => Yii::t('settings', 'Default business hours'),
            'language' => Yii::t('settings', 'Main page language'),
        ];
    }

    /**
     * Do the logo file upload.
     *
     * @return bool
     */
    public function upload()
    {
        if ($this->validate() && ($this->logo instanceof UploadedFile))
        {
            try
            {
                $this->login_logo_image = DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'logo.' . $this->logo->getExtension();
                $this->logo->saveAs(self::getLogoDirectory() . $this->login_logo_image);
                $this->logo = null;
            } catch (Exception $e) {
                $this->addError('logo', Yii::t('settings', 'It is not possible to upload logo now. Please, try again later.'));
                return false;
            }
        }
        return true;
    }

    /**
     * Returns the logo image directory.
     *
     * @return string
     */
    public static function getLogoDirectory()
    {
        return Yii::getAlias('@app') . DIRECTORY_SEPARATOR . 'web';
    }

    /**
     * Returns the language of the main page.
     *
     * @return string
     */
    public function getLanguage()
    {
        return ($this->language != '') ? self::getLanguageData()[$this->language] : '';
    }

    /**
     * Returns all the languages options.
     *
     * @param bool $showIcon Show de icon flag.
     * @return array
     */
    public static function getLanguageData($showIcon = false)
    {
        return [
            self::LANGUAGE_EN_US => (($showIcon)? Icon::show(self::getLanguageCountryData()[self::LANGUAGE_EN_US], [], Icon::FI):'') . Yii::t('general', 'English (United States)'),
            self::LANGUAGE_PT_BR => (($showIcon)? Icon::show(self::getLanguageCountryData()[self::LANGUAGE_PT_BR], [], Icon::FI):'') . Yii::t('general', 'Portuguese (Brazil)')
        ];
    }

    /**
     * Returns all the languages country options.
     *
     * @return array
     */
    public static function getLanguageCountryData()
    {
        return [
            self::LANGUAGE_EN_US => 'us',
            self::LANGUAGE_PT_BR => 'br'
        ];
    }

}
