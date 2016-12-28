<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'uresc-backend',
    'name' => '4ª URE - Administração',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'pt-BR',
    'sourceLanguage' => 'en-US',
    'components' => [
        'request' => [
            'cookieValidationKey' => 'uP-z2cT7YulFE9un9M-YBOHCuLpfysEm',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ]
    ],
    'modules' => [
        'ckeditor' => [
            'class' => 'wadeshuler\ckeditor\Module',
            'preset' => 'standard',
            'widgetClientOptions' => [
                'rows' =>'15',
                'language' => 'pt',
            ],
        ],
    ],
    'params' => $params,
    'layout' => 'sbadmin',
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
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
