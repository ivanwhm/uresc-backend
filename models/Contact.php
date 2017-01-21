<?php
/**
 * This is the model class for table "contact".
 *
 * @property integer $id Contact's ID.
 * @property string $contact_email Contact's e-mail.
 * @property string $contact_message Contact's message.
 * @property datetime $contact_date Contact's date.
 * @property string $contact_ip Contact's IP.
 * @property string $answer_message Contact's answer message.
 * @property datetime $answer_date Contact's answer date.
 * @property integer $answer_user_id Contact's answer user.
 * @property string $answer_sent Contact's answer sent?
 *
 * @property User $answerUser User that answer the contact's message.
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */
namespace app\models;

//Imports
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Html;

class Contact extends ActiveRecord
{

    const ANSWER_SENT_YES = "Y";
    const ANSWER_SENT_NO = "N";

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contact';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['answer_message'], 'required'],
            [['contact_message', 'answer_message'], 'string'],
            [['contact_date', 'answer_date', 'answer_sent'], 'safe'],
            [['answer_user_id'], 'integer'],
            [['contact_email'], 'string', 'max' => 150],
            [['contact_ip'], 'string', 'max' => 255],
            [['answer_sent'], 'string', 'max' => 1],
            [['answer_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['answer_user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('contact', 'ID'),
            'contact_email' => Yii::t('contact', 'E-mail'),
            'contact_message' => Yii::t('contact', 'Message'),
            'contact_date' => Yii::t('contact', 'Date'),
            'contact_ip' => Yii::t('contact', 'IP'),
            'answer_message' => Yii::t('contact', 'Answer'),
            'answer_date' => Yii::t('contact', 'Answer date'),
            'answer_user_id' => Yii::t('contact', 'User who answered'),
            'answeruser.name' => Yii::t('contact', 'User who answered'),
            'answer_sent' => Yii::t('contact', 'Did it answered?'),
        ];
    }

    /**
     * Returns the user that answered the contact's message.
     *
     * @return User
     */
    public function getAnswerUser()
    {
        return User::findOne(['id' => $this->answer_user_id]);
    }

    /**
     * Returns all the contacts awaiting answer.
     *
     * @return integer
     */
    public static function getContactsAwaitingAnswer()
    {
        return self::find(['answer_sent' => self::ANSWER_SENT_NO])->count();
    }

    /**
     * Returns all the answer sent description options.
     *
     * @return array
     */
    public static function getSentData()
    {
        return [
            self::ANSWER_SENT_YES => Yii::t('general', 'Yes'),
            self::ANSWER_SENT_NO => Yii::t('general', 'No')
        ];
    }

    /**
     * Return the description of the answer sent information.
     *
     * @return string
     */
    public function getAnswerSent()
    {
        return ($this->answer_sent != '') ? $result = Html::tag('span', Html::tag('i', '', ['class' => 'glyphicon ' . (($this->answer_sent == self::ANSWER_SENT_YES) ? 'glyphicon-ok' : 'glyphicon-remove')]) . '  ' . self::getSentData()[$this->answer_sent], ['class' => 'label ' . (($this->answer_sent == self::ANSWER_SENT_YES) ? 'label-primary' : 'label-danger')]) : '';
    }

    /**
     * Returns if the answer was sent.
     *
     * @return bool
     */
    public function getIsAnswerSent()
    {
        return $this->answer_sent === self::ANSWER_SENT_YES;
    }
}
