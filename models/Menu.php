<?php
/**
 * This is the model class for table "menu".
 *
 * @property integer $id Menu's ID.
 * @property string $name Menu's name.
 * @property string $visible True if menu is visible.
 * @property integer $order Menu's order.
 * @property string $type Menu's type.
 * @property integer $page_id Menu's page ID.
 * @property datetime $date_created Menu's date of creation.
 * @property datetime $date_updated Menu's date of updated.
 * @property integer $user_created Menu's user created.
 * @property integer $user_updated Menu's user updated.
 *
 * @property Page $page Page related to the menu.
 * @property User $userCreated User that created the menu.
 * @property User $userUpdated User that updated the menu.
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

namespace app\models;

//Imports
use app\components\UreActiveRecord;
use Yii;

class Menu extends UreActiveRecord
{

    const VISIBLE_YES = 'Y';
    const VISIBLE_NO = 'N';

    const TYPE_MENU = 'M';
    const TYPE_PAGE = 'P';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'order'], 'required'],
            [['order', 'page_id', 'user_created', 'user_updated'], 'integer'],
            [['date_created', 'date_updated', 'user_created', 'user_updated'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['visible', 'type'], 'string', 'max' => 1],
            [['page_id'], 'exist', 'skipOnError' => true, 'targetClass' => Page::className(), 'targetAttribute' => ['page_id' => 'id']],
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
            'id' => Yii::t('menu', 'ID'),
            'name' => Yii::t('menu', 'Name'),
            'visible' => Yii::t('menu', 'Visible'),
            'order' => Yii::t('menu', 'Order'),
            'type' => Yii::t('menu', 'Type'),
            'page_id' => Yii::t('menu', 'Page'),
            'date_created' => Yii::t('general', 'Date of creation'),
            'date_updated' => Yii::t('general', 'Date of the update'),
            'user_created' => Yii::t('general', 'User who created'),
            'user_updated' => Yii::t('general', 'User who do last update'),
            'usercreated.name' => Yii::t('general', 'User who created'),
            'userupdated.name' => Yii::t('general', 'User who do last update'),
        ];
    }

    /**
     * Returns the page related to the menu.
     *
     * @return Page
     */
    public function getPage()
    {
        return Page::findOne(['id' => $this->page_id]);
    }

    /**
     * Returns all the visible options.
     *
     * @return array
     */
    public static function getVisibleData()
    {
        return [
            self::VISIBLE_YES => Yii::t('general', 'Yes'),
            self::VISIBLE_NO => Yii::t('general', 'No')
        ];
    }

    /**
     * Returns all the type options.
     *
     * @return array
     */
    public static function getTypeData()
    {
        return [
            self::TYPE_MENU => Yii::t('menu', 'Menu'),
            self::TYPE_PAGE => Yii::t('menu', 'Page')
        ];
    }

    /**
     * Return the visibility description of the menu.
     *
     * @return string
     */
    public function getVisible()
    {
        return ($this->visible != '') ? self::getVisibleData()[$this->visible] : '';
    }

    /**
     * Return the type description of the menu.
     *
     * @return string
     */
    public function getType()
    {
        return ($this->type != '') ? self::getTypeData()[$this->type] : '';
    }

}

