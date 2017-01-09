<?php
/**
 * Class with responsibility to format some information in the system.
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

namespace app\components;

//Imports
use yii\i18n\Formatter;

class UreFormatter extends Formatter
{

    /**
     * Format a value with a phone mask.
     * This class is to pt-br language.
     *
     * @param $value Value to be formatted.
     * @return string
     */
    public function asPhone($value)
    {
        if ((preg_match('^\([0-9]{2}\)[0-9]{4}+-[0-9]{4}^', $value)) or (preg_match('^\([0-9]{2}\)[0-9]{5}+-[0-9]{4}^', $value)))
        {
            return $value;
        } else
        {
            if (strlen($value) == 10)
            {
                return '(' . substr($value, 0, 2) . ') ' . substr($value, 2, 4) . '-' . substr($value, 6, 4);
            } else if (strlen($value) == 11)
            {
                return '(' . substr($value, 0, 2) . ') ' . substr($value, 2, 5) . '-' . substr($value, 7, 4);
            } else
            {
                return $value;
            }
        }
    }

}