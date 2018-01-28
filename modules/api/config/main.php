<?php

$params = array_merge(
    require(__DIR__ . '/../config/params.php'),
    require(__DIR__ . '/params.php')
);
return [
    'id' => 'api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'response' => [
            'formatters' => [
                \yii\web\Response::FORMAT_JSON => [
                    'class' => 'yii\web\JsonResponseFormatter',
                    'prettyPrint' => YII_DEBUG, // используем "pretty" в режиме отладки
                    'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
                ],
            ],
        ],
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
       'user' => [
            'identityClass' => 'api\entities\User',
            'enableAutoLogin' => false,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
               [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => '/user',
                    'extraPatterns' => [
                        'GET registration' => 'registration',
                        'OPTIONS registration' => 'options',
                        'GET login' => 'login',
                        'OPTIONS logig' => 'options',
                        'GET requestPasswordReset' => 'request-password-reset',
                        'OPTIONS requestPasswordReset' => 'options',
                        'GET resetPassword' => 'reset-password',
                        'OPTIONS resetPassword' => 'options',
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => '/application',
                    'extraPatterns' => [
                        'GET create' => 'create',
                        'OPTIONS create' => 'create',
                        'GET search' => 'search',
                        'OPTIONS search' => 'search',
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'comment-apllication',
                    'extraPatterns' => [
                        'GET create' => 'create',
                        'OPTIONS create' => 'create',
                        'GET view' => 'view',
                        'OPTIONS view' => 'view',
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'hello',
                    'extraPatterns' => [
                        'GET hello'=>'hello'
                    ]
                ],

            ],
        ]
    ],
    'params' => $params,
];

