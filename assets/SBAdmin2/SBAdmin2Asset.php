<?php

/**
 * This class is responsible to manager assets about SBAdmin (2) template.
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 * @see https://startbootstrap.com/template-overviews/sb-admin/
 */

namespace app\assets\SBAdmin2;

//Imports
use yii\web\AssetBundle;

class SBAdmin2Asset extends AssetBundle
{
    /**
     * Define the source path to files.
     *
     * @var string
     */
    public $sourcePath = "@app/assets/SBAdmin2/files";

    /**
     * Define the css files to application.
     *
     * @var array
     */
    public $css = [
        "css/sb-admin-2.css",
        "font-awesome/css/font-awesome.css"
    ];

    /**
     * Define the js files to application.
     *
     * @var array
     */
    public $js = [
        "js/sb-admin-2.js"
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