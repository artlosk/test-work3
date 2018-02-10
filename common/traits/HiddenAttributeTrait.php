<?php

namespace app\common\traits;

use app\common\interfaces\HiddenAttributeInterface;
use yii\helpers\ArrayHelper;

/**
 * Trait HiddenAttributeTrait
 *
 */
trait HiddenAttributeTrait
{
    /**
     * @return string
     */
    protected static function getHiddenAttribute()
    {
        return 'hidden';
    }

    /**
     * @return array
     */
    public static function getHiddenList()
    {
        return [
            HiddenAttributeInterface::HIDDEN_NO => 'Нет',
            HiddenAttributeInterface::HIDDEN_YES => 'Да',
        ];
    }

    /**
     * @return string
     */
    public function getHidden()
    {
        return ArrayHelper::getValue(static::getHiddenList(), $this->{static::getHiddenAttribute()});
    }
}
