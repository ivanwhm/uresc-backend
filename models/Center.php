<?php
/**
 * This is the model class for table "center".
 *
 * @property integer $id Center's ID.
 * @property string $name Center's name.
 * @property string $address Center's address.
 * @property string $neighborhood Center's neighborhood.
 * @property string $city Center's city.
 * @property string $state Center's state.
 * @property string $phone Center's phone.
 * @property string $email Center's email.
 * @property string $business_hours Center's business hours.
 * @property integer $calendar_id Calendar of the center.
 * @property datetime $date_created Center's date of creation.
 * @property datetime $date_updated Center's date of updated.
 * @property integer $user_created Center's user created.
 * @property integer $user_updated Center's user updated.
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

class Center extends UreActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'center';
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
            'id' => Yii::t('center', 'ID'),
            'name' => Yii::t('center', 'Name'),
            'address' => Yii::t('center', 'Address'),
            'neighborhood' => Yii::t('center', 'Neighborhood'),
            'city' => Yii::t('center', 'City'),
            'state' => Yii::t('center', 'State'),
            'phone' => Yii::t('center', 'Phone'),
            'email' => Yii::t('center', 'E-mail'),
            'business_hours' => Yii::t('center', 'Business hours'),
            'calendar_id' => Yii::t('center', 'Calendar'),
            'date_created' => Yii::t('general', 'Date of creation'),
            'date_updated' => Yii::t('general', 'Date of the update'),
            'user_created' => Yii::t('general', 'User who created'),
            'user_updated' => Yii::t('general', 'User who do last update'),
        ];
    }

    /**
     * Return all the spiritists centers.
     *
     * @return integer
     */
    public static function getCenterCount()
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
