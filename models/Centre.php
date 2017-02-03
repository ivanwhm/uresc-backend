<?php
/**
 * This is the model class for table "centre".
 *
 * @property integer $id Centre's ID.
 * @property string $name Centre's name.
 * @property string $address Centre's address.
 * @property string $neighborhood Centre's neighborhood.
 * @property string $city Centre's city.
 * @property string $state Centre's state.
 * @property string $phone Centre's phone.
 * @property string $email Centre's email.
 * @property string $business_hours Centre's business hours.
 * @property integer $calendar_id Calendar of the centre.
 * @property datetime $date_created Centre's date of creation.
 * @property datetime $date_updated Centre's date of updated.
 * @property integer $user_created Centre's user created.
 * @property integer $user_updated Centre's user updated.
 *
 * @property User $userCreated User that created the centre.
 * @property User $userUpdated User that updated the centre.
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */
namespace app\models;

//Imports
use app\components\UreActiveRecord;
use Yii;

class Centre extends UreActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'centre';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'address', 'city', 'neighborhood', 'state', 'business_hours'], 'required'],
            [['user_created', 'user_updated', 'calendar_id'], 'integer'],
            [['user_created', 'user_updated', 'date_created', 'date_updated', 'calendar_id'], 'safe'],
            [['name', 'neighborhood', 'business_hours'], 'string', 'max' => 100],
            [['address'], 'string', 'max' => 255],
            [['city', 'email'], 'string', 'max' => 150],
            [['state'], 'string', 'max' => 2],
            [['phone'], 'string', 'max' => 20],
            [['email'], 'email'],
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
            'id' => Yii::t('centre', 'ID'),
            'name' => Yii::t('centre', 'Name'),
            'address' => Yii::t('centre', 'Address'),
            'neighborhood' => Yii::t('centre', 'Neighborhood'),
            'city' => Yii::t('centre', 'City'),
            'state' => Yii::t('centre', 'State'),
            'phone' => Yii::t('centre', 'Phone'),
            'email' => Yii::t('centre', 'E-mail'),
            'business_hours' => Yii::t('centre', 'Business hours'),
            'calendar_id' => Yii::t('centre', 'Calendar'),
            'date_created' => Yii::t('general', 'Date of creation'),
            'date_updated' => Yii::t('general', 'Date of the update'),
            'user_created' => Yii::t('general', 'User who created'),
            'user_updated' => Yii::t('general', 'User who do last update'),
        ];
    }

    /**
     * Return all the spiritists centres.
     *
     * @return integer
     */
    public static function getCentreCount()
    {
        return self::find()->count();
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

}
