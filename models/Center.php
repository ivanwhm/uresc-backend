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
use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;

class Center extends ActiveRecord
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
            [['user_created', 'user_updated'], 'integer'],
            [['user_created', 'user_updated', 'date_created', 'date_updated'], 'safe'],
            [['name', 'neighborhood', 'business_hours'], 'string', 'max' => 100],
            [['address'], 'string', 'max' => 255],
            [['city', 'email'], 'string', 'max' => 150],
            [['state'], 'string', 'max' => 2],
            [['phone'], 'string', 'max' => 11],
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
            'name' => 'Nome',
            'address' => 'Endereço',
            'neighborhood' => 'Bairro',
            'city' => 'Cidade',
            'state' => 'Estado',
            'phone' => 'Telefone',
            'email' => 'E-mail',
            'business_hours' => 'Horário de funcionamento',
            'date_created' => 'Data da criação',
            'date_updated' => 'Data da última atualização',
            'user_created' => 'Usuário que criou',
            'user_updated' => 'Usuário da última atualização'
        ];
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

    /**
     * Return all the spiritists centers.
     *
     * @return integer
     */
    public static function getCenterCount()
    {
        return self::find()->count();
    }

}
