<?php

namespace app\modules\employee;

use Yii;

/**
 * employee module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\employee\controllers';

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/employee/' . $category, $message, $params, $language);
    }
}
