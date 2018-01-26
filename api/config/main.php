<?php

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'), require(__DIR__ . '/../../common/config/params-local.php'), require(__DIR__ . '/params.php'), require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'prioriti-api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'v1' => [
            'basePath' => '@app/modules/v1',
            'class' => 'api\modules\v1\Module'
        ],
    ],
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
            'identityClass' => 'api\models\User',
            'enableAutoLogin' => false,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['v1/order'],
                    'tokens' => [
                        '{id}' => '<id:\\w+>'
                    ],
                    'extraPatterns' => [
                        'POST fio'=>'get-fio',
                        'POST list'=>'get-list'
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['v1/bonus'],
                    'tokens' => [
                        '{id}' => '<id:\\w+>'
                    ],
                    'extraPatterns' => [
                        'POST bonus'=>'bonus',
                        'POST transaction'=>'transaction'
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['v1/shop-app'],
                    'tokens' => [
                        '{id}' => '<id:\\w+>'
                    ],
                    'extraPatterns' => [
                        'POST register'=>'register-new-app'
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['v1/user'],
                    'tokens' => [
                        '{id}' => '<id:\\w+>'
                    ],
                    'extraPatterns' => [
                        'POST validation'=>'validation'
                    ]
                ],

            ],
        ]
    ],
    'params' => $params,
];

