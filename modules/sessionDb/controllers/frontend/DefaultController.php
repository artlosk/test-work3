<?php

namespace app\modules\sessionDb\controllers\frontend;

use app\modules\sessionDb\components\SessionDb;
use yii\web\Controller;

/**
 * Class DefaultController
 * @package app\modules\sessionDb\controllers\frontend
 */
class DefaultController extends Controller
{
    /**
     * @var SessionDb
     */
    public $handler;

    /**
     * @param $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        $this->handler = new SessionDb();
        @session_set_save_handler($this->handler, true);
        @session_start();
        return parent::beforeAction($action);
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $data = $_SESSION ?? [];
        return $this->render('index', ['data' => $data]);
    }

    /**
     * @param $key
     * @param $value
     * @return string
     */
    public function actionCreate($key, $value)
    {
        if (\Yii::$app->request->isAjax) {
            $this->handler->set('test_' . $key, $value);
            session_write_close();
            //sleep(10);
            return $this->renderAjax('_data', ['data' => $_SESSION ?? []]);
        }
    }

    /**
     * @param $key
     * @return \yii\web\Response
     */
    public function actionDelete($key)
    {
        $this->handler->remove($key);
        return $this->asJson(['success' => true]);
    }


}
