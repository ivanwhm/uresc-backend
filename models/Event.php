<?php
/**
 * This is the model class for table "event".
 *
 * @property integer $id Event's ID.
 * @property integer $calendar_id Event's calendar.
 * @property string $name Event's name.
 * @property date $date Event's date.
 * @property time $start_time Event's start time.
 * @property time $end_time Event's end time.
 * @property string $info Event' more information.
 * @property datetime $date_created Events's date of creation.
 * @property datetime $date_updated Events's date of updated.
 * @property integer $user_created Events's user created.
 * @property integer $user_updated Events's user updated.
 *
 * @property Calendar $calendar Calendar that event was created.
 * @property User $userCreated User that created the event.
 * @property User $userUpdated User that updated the event.
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */
namespace app\models;

//Imports
use Yii;
use yii\db\Expression;

class Event extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['calendar_id', 'date', 'start_time', 'end_time'], 'required'],
            [['calendar_id', 'user_created', 'user_updated'], 'integer'],
            [['date_created', 'date_updated', 'user_created', 'user_updated'], 'safe'],
            [['info'], 'string'],
            [['name'], 'string', 'max' => 100],
            [['calendar_id'], 'exist', 'skipOnError' => true, 'targetClass' => Calendar::className(), 'targetAttribute' => ['calendar_id' => 'id']],
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
            'calendar_id' => 'Calendário',
            'name' => 'Descrição',
            'date' => 'Data',
            'start_time' => 'Início',
            'end_time' => 'Término',
            'info' => 'Mais informações',
            'date_created' => 'Data da criação',
            'date_updated' => 'Data da última atualização',
            'user_created' => 'Usuário que criou',
            'user_updated' => 'Usuário da última atualização'
        ];
    }

    /**
     * Returns the calendar of the event.
     *
     * @return Calendar
     */
    public function getCalendar()
    {
        $calendar = Calendar::findOne(['id' => $this->calendar_id]);
        return $calendar;
    }

    /**
     * Returns the user that created the calendar.
     *
     * @return User
     */
    public function getUserCreated()
    {
        return User::findOne(['id' => $this->user_created]);
    }

    /**
     * Returns the user that updated the calendar.
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
        if ($insert)
        {
            $this->date_created = new Expression('current_timestamp');
            $this->user_created = Yii::$app->getUser()->getId();
        }

        $this->date_updated = new Expression('current_timestamp');
        $this->user_updated = Yii::$app->getUser()->getId();

        return parent::beforeSave($insert);
    }

}
