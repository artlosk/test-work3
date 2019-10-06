<?php

namespace app\modules\sessionDb\assets;

use yii\web\AssetBundle;

/**
 * Class SessionAsset
 * @package app\modules\sessionDb\assets
 */
class SessionAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@app/modules/sessionDb/assets/dist';

    public $js = [
        'session.manage.js'
    ];

    /**
     * @var array
     */
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}