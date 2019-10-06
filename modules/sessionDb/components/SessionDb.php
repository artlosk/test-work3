<?php

namespace app\modules\sessionDb\components;

use yii\base\BaseObject;
use yii\db\Connection;
use yii\db\Query;
use yii\di\Instance;

/**
 * Class SessionDb
 * @package app\modules\sessionDb\components
 */
class SessionDb extends BaseObject implements \SessionHandlerInterface, \SessionIdInterface
{
    /**
     * @var Connection|array|string
     */
    public $db = 'db';

    /**
     * @var string
     */
    public $table = '{{%session_db}}';

    /**
     * @var int
     */
    public $serverId;

    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        $this->db = Instance::ensure($this->db, Connection::className());

        if (session_status() == PHP_SESSION_ACTIVE) {
            session_write_close();
        }

        session_set_save_handler(
            [$this, "open"],
            [$this, "close"],
            [$this, "read"],
            [$this, "write"],
            [$this, "destroy"],
            [$this, "gc"]
        );

        $this->serverId = rand(1, 3);
    }

    /**
     * @return string
     */
    public function create_sid()
    {
        if (!session_id()) {
            return session_create_id();
        }
        return session_id();
    }

    /**
     * @param string $savePath
     * @param string $sessionName
     * @return bool
     */
    public function open($savePath, $sessionName)
    {
        if ($this->db) {
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function close()
    {
        if ($this->db->close()) {
            return true;
        }
        return false;
    }

    /**
     * @param string $id
     * @return false|string|null
     */
    public function read($id)
    {
        $query = new Query();

        $query->from($this->table)->where('[[sessionId]]=:id', [ ':id' => $id]);
        $data = $query->select(['sessionData'])->scalar($this->db);

        return $data === false ? '' : $data;
    }

    /**
     * @param string $id
     * @param string $data
     * @return bool
     * @throws \yii\db\Exception
     */
    public function write($id, $data)
    {
        $checkExists = $this->db->createCommand("SELECT sessionData FROM " . $this->table . " WHERE sessionId = :sessionId")->bindValues([':sessionId' => $id])->queryOne();


        if ($checkExists) {
            $this->db->createCommand()->update($this->table, ['expireAt' => time(), 'sessionData' => $data], ['sessionId' => $id])->execute();

        } else {
            $this->db->createCommand()->insert($this->table, ['serverId' => $this->serverId, 'sessionId' => $id, 'expireAt' => time(), 'sessionData' => $data])->execute();
        }
        return true;
    }

    /**
     * @param string $id
     * @return bool
     * @throws \yii\db\Exception
     */
    public function destroy($id)
    {
        $this->db->createCommand()->delete($this->table, ['sessionId' => $id])->execute();
        return true;
    }

    /**
     * @param int $max
     * @return bool
     * @throws \yii\db\Exception
     */
    public function gc($max)
    {
        $this->db->createCommand()
            ->delete($this->table, '[[expireAt]] < :expire', [':expire' => time() - $max])
            ->execute();
        return true;
    }

    /**
     * @param $key
     * @param null $defaultValue
     * @return mixed|null
     */
    public function get($key, $defaultValue = null)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : $defaultValue;
    }

    /**
     * @param $key
     * @param $value
     */
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function remove($key)
    {
        if (isset($_SESSION[$key])) {
            $value = $_SESSION[$key];
            unset($_SESSION[$key]);

            return $value;
        }

        return null;
    }

    /**
     *
     */
    public function removeAll()
    {
        foreach (array_keys($_SESSION) as $key) {
            unset($_SESSION[$key]);
        }
    }
}