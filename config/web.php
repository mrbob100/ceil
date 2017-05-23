<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'layout' => 'main.twig',
    'language' => 'ru_RU',
    //'defaultRoute' => 'site/login',
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
            'layout' => 'admin',
            'defaultRoute' => 'order/index',

        ],

    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'toyop4565640980fghghghbdfshhhg',
            //  'baseUrl'  => '',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
          //      'loginUrl' => 'site/login',   //перенаправление на страницу авторизации по умолчанию site/login
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
            /*  'transport' => [
                  'class' => 'Swift_SmtpTransport',
                  'host' => 'smtp.mail.ru',
                  'username' => 'username',
                  'password' => 'password',
                  'port' => '465',
                  'encryption' => 'ssl',
              ],*/
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
        'db' => require(__DIR__ . '/db.php'),

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                // 'category/<id:\d+>/page/<page:\d+>' => 'category/view',

                'category/<id:\d+>' => 'category/view',
                'product/<id:\d+>' => 'product/view',

               // 'search' => 'category/search',

            ],
        ],


        'view' => [
            'class' => 'yii\web\View',
            'defaultExtension' => 'twig',
            'theme'            => [
                'basePath' => '@app/themes/default',
                'baseUrl'  => '@web/themes/default'
            ],
            'renderers' => [
                'twig' => [
                    'class' => 'yii\twig\ViewRenderer',
                    'cachePath' => '@runtime/Twig/cache',
                    // Array of twig options:
                    'options' => [
                        'auto_reload' => true,
                    ],
                    'globals' => ['html' => '\yii\helpers\Html'],
                    'uses' => ['yii\bootstrap'],
                    'filters'    => [
                        'dump'       => '\yii\helpers\BaseVarDumper::dump'
                    ],

                    'namespaces' => [
                        '@app/themes/default/views/layouts' => 'layouts',
                        '@app/views/layouts'                => 'layouts',
                        '@app/themes/default/views'         => '__main__',
                        '@app/views'                        => '__main__'
                    ],
                ],
                // ...
            ],
        ],

    ],

    'controllerMap' => [
        'elfinder' => [
            'class' => 'mihaildev\elfinder\PathController',
            'access' => ['@'],
            'root' => [
                'baseUrl'=>'/web',
//                'basePath'=>'@webroot',
                'path' => 'upload/global',
                'name' => 'Global'
            ],
        ]
    ],
    'params' => $params,
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
