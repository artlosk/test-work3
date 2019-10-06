<?php

return [
    'id' => 'app-console',
    'controllerNamespace' => 'app\commands',
    'modules' => [
        'user' => [
            'class' => 'app\modules\user\Module',
            'controllerNamespace' => 'app\modules\user\controllers\console',
        ],
        'sessionDb' => [
            'class' => 'app\modules\sessionDb\Module',
            'controllerNamespace' => 'app\modules\sessionDb\controllers\console',
        ]
    ],
];
