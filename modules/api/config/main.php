<?php


return [
    'id' => 'api',
    'components' => [
        'response' => [
            'class'=> '\yii\web\Response',
            'formatters' => [
                \yii\web\Response::FORMAT_JSON => [
                    'class' => 'yii\web\JsonResponseFormatter',
                    'prettyPrint' => YII_DEBUG, // используем "pretty" в режиме отладки
                    'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
                ],
            ],
        ],
        'request' => [
            'class'=>'yii\web\Request',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'urlManager' => [
            'class'=>'yii\web\UrlManager',
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
                        'GET add' => 'add',
                        'OPTIONS add' => 'add',
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
];

