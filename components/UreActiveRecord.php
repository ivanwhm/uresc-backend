<?php
/**
 * @inheritdoc
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

namespace app\components;

//Imports
use app\models\User;
use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;

class UreActiveRecord extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if ($insert)
        {
            if ($this->hasAttribute('date_created'))
                $this->date_created = new Expression('current_timestamp');
            if ($this->hasAttribute('user_created'))
                $this->user_created = Yii::$app->getUser()->getId();
        }

        if ($this->hasAttribute('date_updated'))
            $this->date_updated = new Expression('current_timestamp');
        if ($this->hasAttribute('user_updated'))
            $this->user_updated = Yii::$app->getUser()->getId();

        return parent::beforeSave($insert);
    }


    /**
     * Returns the user that created the record.
     *
     * @return User
     */
    public function getUserCreated()
    {
        if ($this->hasAttribute('user_created'))
            return User::findOne(['id' => $this->user_created]);
    }

    /**
     * Returns the user that updated the record.
     *
     * @return User
     */
    public function getUserUpdated()
    {
        if ($this->hasAttribute('user_updated'))
            return User::findOne(['id' => $this->user_updated]);
    }

    /**
     * Returns the created information to print on views.
     *
     * @return string
     */
    public function printCreatedInformation()
    {
        if ($this->hasAttribute('date_created'))
        {
            return Yii::t('general', 'Created on {date} by {username}.', [
                'date' => Yii::$app->getFormatter()->asDatetime($this->date_created),
                'username' => $this->getUserCreated()->getName()
            ]);
        }
    }

    /**
     * Returns the last updated information to print on views.
     *
     * @return string
     */
    public function printLastUpdatedInformation()
    {
        if ($this->hasAttribute('date_updated'))
        {
            return Yii::t('general', 'Last update on {date} by {username}.', [
                'date' => Yii::$app->getFormatter()->asDatetime($this->date_updated),
                'username' => $this->getUserUpdated()->getName()
            ]);
        }
    }
}