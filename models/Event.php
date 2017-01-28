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
 * @property string $place Event's place.
 * @property string $info Event's more information.
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
use app\components\UreActiveRecord;
use Yii;

class Event extends UreActiveRecord
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
            [['calendar_id', 'date', 'start_time', 'end_time', 'place'], 'required'],
            [['calendar_id', 'user_created', 'user_updated'], 'integer'],
            [['date_created', 'date_updated', 'user_created', 'user_updated'], 'safe'],
            [['info', 'place'], 'string'],
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
            'id' => Yii::t('event', 'ID'),
            'calendar_id' => Yii::t('event', 'Calendar'),
            'name' => Yii::t('event', 'Name'),
            'date' => Yii::t('event', 'Date'),
            'start_time' => Yii::t('event', 'Start time'),
            'end_time' => Yii::t('event', 'End time'),
            'place' => Yii::t('event', 'Place'),
            'info' => Yii::t('event', 'More information'),
            'date_created' => Yii::t('general', 'Date of creation'),
            'date_updated' => Yii::t('general', 'Date of the update'),
            'user_created' => Yii::t('general', 'User who created'),
            'user_updated' => Yii::t('general', 'User who do last update'),
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
     * Returns all the further events.
     *
     * @return integer
     */
    public static function getFurtherEvents()
    {
        return self::find(['date > now()'])->count();
    }

}
