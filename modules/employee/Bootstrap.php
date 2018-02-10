<?php

namespace app\modules\employee;

use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->i18n->translations['modules/employee/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'forceTranslation' => true,
            'basePath' => '@app/modules/employee/messages',
            'fileMap' => [
                'modules/employee/module' => 'module.php',
            ],
        ];
    }
}