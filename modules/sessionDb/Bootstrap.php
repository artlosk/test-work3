<?php

namespace app\modules\sessionDb;

use app\modules\sessionDb\components\SessionDb;
use yii\base\BootstrapInterface;

/**
 * Class Bootstrap
 * @package app\modules\sessionDb
 */
class Bootstrap implements BootstrapInterface
{
    /**
     * @param \yii\base\Application $app
     */
    public function bootstrap($app)
    {

        $app->i18n->translations['modules/sessionDb/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'forceTranslation' => true,
            'basePath' => '@app/modules/sessionDb/messages',
            'fileMap' => [
                'modules/sessionDb/module' => 'module.php',
            ],
        ];
    }
}