<?php
/**
 * This is the general class to do the general things.
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

namespace app\components;

//Imports
use app\models\Department;

class General
{
    /**
     * @return Department[]
     */
    public static function getDepartments()
    {
        return Department::find(['status' => Department::STATUS_ACTIVE])->orderBy('name')->all();
    }
}