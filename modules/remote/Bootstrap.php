<?php

namespace app\modules\remote;

use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->i18n->translations['modules/remote/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'forceTranslation' => true,
            'basePath' => '@app/modules/remote/messages',
            'fileMap' => [
                'modules/remote/module' => 'module.php',
            ],
        ];
    }
}