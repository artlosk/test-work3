<?php

namespace app\modules\remote;

use Yii;

/**
 * remote module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\remote\controllers';

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/remote/' . $category, $message, $params, $language);
    }
}
