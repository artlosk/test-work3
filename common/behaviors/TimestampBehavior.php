<?php
namespace app\common\behaviors;

use DateTime;
use yii\base\Event;

/**
 * Class TimestampBehavior
 * @package app\common\behaviors
 */
class TimestampBehavior extends \yii\behaviors\TimestampBehavior
{
    /**
     * @var string
     */
    public $createdAtAttribute = 'createdAt';

    /**
     * @var string
     */
    public $updatedAtAttribute = 'updatedAt';

    /**
     * @param Event $event
     *
     * @return string
     */
    protected function getValue($event)
    {
        return $this->value ?: (new DateTime())->format('Y-m-d H:i:s');
    }
}
