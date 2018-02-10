<?php

namespace app\common\interfaces;

/**
 * Interface HiddenAttributeInterface
 *
 */
interface HiddenAttributeInterface
{
    const HIDDEN_NO = 0;
    const HIDDEN_YES = 1;

    /**
     * @return array
     */
    public static function getHiddenList();

    /**
     * @return string
     */
    public function getHidden();
}
