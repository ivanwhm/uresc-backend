<?php
/**
 * This is the model class for table "page".
 *
 * @property integer $id Page's ID.
 * @property string $name Page's name.
 * @property string $type Page's type.
 * @property string $text Page's text.
 * @property datetime $date_created Page's date of creation.
 * @property datetime $date_updated Page's date of updated.
 * @property integer $user_created Page's user created.
 * @property integer $user_updated Page's user updated.
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

class Page extends ActiveRecord
{
    const PAGE_TYPE_URE = "U";
    const PAGE_TYPE_LIGHT_MESSENGERS = "M";
    const PAGE_THE_SPIRITISM = 'S';

    /**
     * Returns all the page types.
     *
     * @var array
     */
    public static $typeData = [
        self::PAGE_TYPE_URE => "4ª URE",
        self::PAGE_TYPE_LIGHT_MESSENGERS => "Mensageiros da Luz",
        self::PAGE_THE_SPIRITISM => 'O Espiritismo'
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['text'], 'required', 'on' => 'info'],
            [['text'], 'string'],
            [['user_created', 'user_updated', 'date_created', 'date_updated'], 'safe'],
            [['user_created', 'user_updated'], 'integer'],
            [['name'], 'string', 'max' => 150],
            [['type'], 'string', 'max' => 1],
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
            'type' => 'Tipo',
            'text' => 'Texto da página',
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
     * Return all the pages.
     *
     * @return Page[]
     */
    public static function getPages()
    {
        return self::find()->orderBy('name')->all();
    }
}
