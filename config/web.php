<?php

$config = [
    'id' => 'app',
    'language' => 'ru-RU',
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
            'layout' => '@app/views/layouts/admin',
            'modules' => [
                'user' => [
                    'class' => 'app\modules\user\Module',
                    'controllerNamespace' => 'app\modules\user\controllers\backend',
                    'viewPath' => '@app/modules/user/views/backend',
                ],
                'employee' => [
                    'class' => 'app\modules\employee\Module',
                    'controllerNamespace' => 'app\modules\employee\controllers\backend',
                    'viewPath' => '@app/modules/employee/views/backend',
                ],
            ]
        ],
        'main' => [
            'class' => 'app\modules\main\Module',
        ],
        'user' => [
            'class' => 'app\modules\user\Module',
            'controllerNamespace' => 'app\modules\user\controllers\frontend',
            'viewPath' => '@app/modules/user/views/frontend',
        ],
        'employee' => [
            'class' => 'app\modules\employee\Module',
            'controllerNamespace' => 'app\modules\employee\controllers\frontend',
            'viewPath' => '@app/modules/employee/views/frontend',
        ],
        'remote' => [
            'class' => 'app\modules\remote\Module',
            'controllerNamespace' => 'app\modules\remote\controllers\frontend',
            'viewPath' => '@app/modules/remote/views/frontend',
        ],
    ],
    'components' => [
        'user' => [
            'identityClass' => 'app\components\UserIdentity',
            'enableAutoLogin' => true,
            'loginUrl' => ['user/default/login'],
        ],
        'errorHandler' => [
            'errorAction' => 'main/default/error',
        ],
        'request' => [
            'cookieValidationKey' => '',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
