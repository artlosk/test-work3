<?php

namespace app\modules\remote\controllers\frontend;


class EmployeesController extends \yii\web\Controller
{
    private $pageSize = 3;

    public function actionIndex()
    {
        $searchName = \Yii::$app->request->get('searchName');
        $searchDepartment = \Yii::$app->request->get('searchDepartment');
        $searchStatus = \Yii::$app->request->get('searchStatus');

        $departmentList = $this->getDepartments("http://test.work/employee/employee/get-departments");
        $employeeList = $this->getEmployees("http://test.work/employee/employee/get-employees", $searchName, $searchDepartment, $searchStatus);


        $employeeProvider = [];
        if ($employeeList) {
            $employeeProvider = new \yii\data\ArrayDataProvider([
                'allModels' => $employeeList,
                'pagination' => ['defaultPageSize' => $this->pageSize],
            ]);
        }


        $departmentProvider = [];
        if ($departmentList) {
            $departmentProvider = new \yii\data\ArrayDataProvider([
                'allModels' => $departmentList,
                'pagination' => ['defaultPageSize' => $this->pageSize + 20],
            ]);
        }

        return $this->render('index', [
            'employeeProvider' => $employeeProvider,
            'departmentProvider' => $departmentProvider,
            'departmentList' => $departmentList,
        ]);

    }

    private function GetDepartments($url)
    {
        $context = stream_context_create(array('http' => array('header' => 'Accept: application/xml')));
        $xml = file_get_contents($url, false, $context);
        $xml = simplexml_load_string($xml);
        $departemntsList = [];
        if ($xml->status) {
            if (isset($xml->data->item[0])) {
                foreach ($xml->data->item as $val) {
                    $departemntsList[(int)$val->id] = (string)$val->title;
                }
            }
        }
        return $departemntsList;
    }

    private function getEmployees($url, $searchName = '', $searchDepartment = '', $searchStatus = '')
    {
        $context = stream_context_create(array('http' => array('header' => 'Accept: application/xml')));
        $xml = file_get_contents($url, false, $context);
        $xml = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
        $employeesList = [];

        if ($xml->status) {
            $arr = json_decode(json_encode($xml->data), 1);
            if (!empty($arr['item'])) {
                if ($searchName != '') {
                    $arr['item'] = array_filter($arr['item'], function ($a) use ($searchName) {
                        return mb_strrpos((string)trim($a['name']), strip_tags($searchName)) !== false;
                    });
                }
                if ($searchDepartment != '') {
                    $arr['item'] = array_filter($arr['item'], function ($a) use ($searchDepartment) {
                        return mb_strrpos((string)trim($a['department']['id']), strip_tags($searchDepartment)) !== false;
                    });
                }

                if ($searchStatus != '') {
                    $arr['item'] = array_filter($arr['item'], function ($a) use ($searchStatus) {
                        return mb_strrpos((string)trim($a['status']), strip_tags($searchStatus)) !== false;
                    });
                }
                $employeesList = $arr['item'];
            }

        }
        return $employeesList;
    }

}
