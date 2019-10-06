<?php
namespace app\modules\sessionDb\controllers\console;

use yii\console\Controller;
use yii\db\Connection;
use yii\di\Instance;

/**
 * Class GarbageController
 * @package app\modules\sessionDb\controllers\console
 */
class GarbageController extends Controller
{
    public function actionRun()
    {
        $maxLifeTime = ini_get('session.gc_maxlifetime');

        $db = Instance::ensure('db', Connection::className());
        $db->createCommand()
            ->delete('{{%session_db}}', '[[expireAt]] < :expire', [':expire' => time() - $maxLifeTime])
            ->execute();
    }
}