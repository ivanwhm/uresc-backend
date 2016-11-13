<?php

/**
 * This class is responsible to manager assets about SBAdmin template.
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 * @see https://startbootstrap.com/template-overviews/sb-admin/
 */

namespace app\assets\SBAdmin;

//Imports
use yii\web\AssetBundle;

class SBAdminAsset extends AssetBundle
{
    /**
     * Define the sourcepath to files.
     *
     * @var string
     */
    public $sourcePath = "@app/assets/SBAdmin/files";

    /**
     * Define the css files to the application.
     *
     * @var array
     */
    public $css = [
        "css/sb-admin.css",
        "css/font-awesome.css"
    ];

    /**
     * Define the dependencies to the application.
     *
     * @var array
     */
    public $depends = [
        "yii\web\JqueryAsset",
        "yii\bootstrap\BootstrapAsset",
        "yii\bootstrap\BootstrapPluginAsset"
    ];
}