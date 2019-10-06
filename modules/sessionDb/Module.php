<?php

namespace app\modules\sessionDb;

use app\modules\sessionDb\components\SessionDb;
use Yii;

/**
 * remote module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\sessionDb\controllers';

    /**
     * @param $category
     * @param $message
     * @param array $params
     * @param null $language
     * @return string
     */
    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/sessionDb/' . $category, $message, $params, $language);
    }
}
