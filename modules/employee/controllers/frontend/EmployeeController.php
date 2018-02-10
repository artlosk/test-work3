<?php

namespace app\modules\employee\controllers\frontend;

use app\modules\employee\models\Department;
use app\modules\employee\models\Employee;

class EmployeeController extends \yii\rest\ActiveController
{
    public $modelClass = Employee::class;

    /**
     * @return array
     */
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    public function actionGetEmployees()
    {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_XML;
        $employee = Employee::find()->with('department')->asArray()->all();
        if (count($employee) > 0) {
            return array('status' => true, 'data' => $employee);
        } else {
            return array('status' => false, 'data' => 'Ничего не найдено');
        }
    }

    public function actionGetDepartments()
    {
        \Yii::$app->response->format = \yii\web\Response:: FORMAT_XML;
        $department = Department::find()->hidden()->asArray()->all();
        if (count($department) > 0) {
            return array('status' => true, 'data' => $department);
        } else {
            return array('status' => false, 'data' => 'Ничего не найдено');
        }
    }

}
