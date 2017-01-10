<?php
/**
 * This is the model class for table "config".
 *
 * @property integer $id Config's ID.
 * @property string $phrase Phrase that will be presented in header page.
 * @property string $phrase_author Author of the phrase that will be presented in header page.
 * @property string $page_title Title of the main page.
 * @property string $date_updated Config's date of updated.
 * @property integer $user_updated Config's user updated.
 *
 * @property User $userUpdated User that updated the calendar.
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */
namespace app\models;

//Imports
use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;

class Config extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'config';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_updated', 'user_updated'], 'safe'],
            [['phrase', 'phrase_author', 'page_title'], 'required'],
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
            'id' => 'ID',
            'phrase' => 'Frase principal',
            'phrase_author' => 'Autor da frase principal',
            'page_title' => 'Título da página principal',
            'date_updated' => 'Data da última atualização',
            'user_updated' => 'Usuário da última atualização',
            'userupdated.name' => 'Usuário da última atualização',
        ];
    }


    /**
     * Returns the user that updated the config.
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
        $this->date_updated = new Expression('current_timestamp');
        $this->user_updated = Yii::$app->getUser()->getId();

        return parent::beforeSave($insert);
    }}
