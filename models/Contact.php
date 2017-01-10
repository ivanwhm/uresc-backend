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
 * @property string $answer_date Contact's answer date.
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

class Contact extends ActiveRecord
{

    const ANSWER_SENT_YES = "Y";
    const ANSWER_SENT_NO = "N";

    /**
     * Returns all the answer sent options.
     *
     * @var array
     */
    public static $answerSentData = [
        self::ANSWER_SENT_YES => "Sim",
        self::ANSWER_SENT_NO => "Não"
    ];

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
            'id' => 'Código',
            'contact_email' => 'E-mail',
            'contact_message' => 'Mensagem',
            'contact_date' => 'Data',
            'contact_ip' => 'IP',
            'answer_message' => 'Resposta',
            'answer_date' => 'Data da resposta',
            'answer_user_id' => 'Usuário que respondeu',
            'answeruser.name' => 'Usuário que respondeu',
            'answer_sent' => 'Respondido?',
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
     * Return the description of the answer sent information.
     *
     * @return string
     */
    public function getAnswerSent()
    {
        return ($this->answer_sent != '') ? self::$answerSentData[$this->answer_sent] : '';
    }

    /**
     * Returns if the answer was sent.
     *
     * @return bool
     */
    public function getIsNoAnswerSent()
    {
        return $this->answer_sent === self::ANSWER_SENT_NO;
    }
}
