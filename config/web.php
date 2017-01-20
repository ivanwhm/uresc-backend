<?php

use kartik\date\DatePicker;
use \kartik\datecontrol\Module;

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'uresc-backend',
    'name' => 'Admin',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'en-US',
    'sourceLanguage' => 'en-US',
    'timeZone' => 'UTC',
    'components' => [
        'request' => [
            'cookieValidationKey' => 'uP-z2cT7YulFE9un9M-YBOHCuLpfysEm',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableSession' => true
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'formatter' => [
            'datetimeFormat' => 'short',
            'dateFormat' => 'short',
            'timeFormat' => 'short',
            'nullDisplay' => ''
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                ],
            ],
        ],
    ],
    'modules' => [
        'ckeditor' => [
            'class' => '\wadeshuler\ckeditor\Module',
            'preset' => 'standard',
            'widgetClientOptions' => [
                'lang' => 'pt-br',
                'rows' =>'15',
            ],
        ],
        'datecontrol' =>  [
            'class' => '\kartik\datecontrol\Module',
            'displaySettings' => [
                Module::FORMAT_DATE => 'short',
                Module::FORMAT_TIME => 'short',
            ],
            'saveSettings' => [
                Module::FORMAT_DATE => 'php:Y-m-d',
                Module::FORMAT_TIME => 'php:H:i:s',
            ],
            'displayTimezone' => 'UTC',
            'saveTimezone' => 'UTC',
            'autoWidget' => true,
            'autoWidgetSettings' => [
                Module::FORMAT_DATE => [
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    'pluginOptions' => [
                        'autoclose' => true
                    ]
                ],
            ],
        ]
    ],
    'params' => $params,
    'layout' => 'sbadmin',
];

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
