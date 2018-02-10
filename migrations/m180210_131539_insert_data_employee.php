<?php

use yii\db\Migration;
use app\modules\employee\models\Department;
use app\modules\employee\models\Employee;

class m180210_131539_insert_data_employee extends Migration
{
    public function safeUp()
    {

        $departments = [
            [
                'title' => 'Бухгалтерия',
            ],
            [
                'title' => 'ИТ',
            ],
            [
                'title' => 'Консалтинг',
            ],
            [
                'title' => 'Call центр',
            ],

        ];

        foreach ($departments as $department) {
            $this->insert(Department::tableName(), [
                'title' => $department['title'],
                'hidden' => Department::HIDDEN_NO,
                'createdAt' => date('Y-m-d H:i:s'),
                'updatedAt' => date('Y-m-d H:i:s'),
            ]);
        }

        $employees = [
            [
                'pin' => '1111',
                'name' => 'Иванов Иван Иванович',
                'email' => 'ivan@ivan.ivan',
                'phone' => '+996(555)111-111',
                'address' => '11-11-11',
            ],
            [
                'pin' => '2222',
                'name' => 'Сергеев Сергей Сергеевич',
                'email' => 'sergey@sergey.sergey',
                'phone' => '+996(555)222-222',
                'address' => '12-12-12',
            ],
            [
                'pin' => '3333',
                'name' => 'Петров Петр Петрович',
                'email' => 'petr@petr.petr',
                'phone' => '+996(555)333-333',
                'address' => '10-10-10',
            ],
            [
                'pin' => '4444',
                'name' => 'Васильев Василий Васильевич',
                'email' => 'vasiliy@vasiliy.vasiliy',
                'phone' => '+996(555)444-444',
                'address' => 'ул. Пожарского 1',
            ],
        ];

        $departmentArr = Department::find()->select('id')->asArray()->indexBy('id')->column();

        foreach ($employees as $employee) {
            $this->insert(Employee::tableName(), [
                'departmentId' => array_rand($departmentArr),
                'pin' => $employee['pin'],
                'name' => $employee['name'],
                'email' => $employee['email'],
                'phone' => $employee['phone'],
                'address' => $employee['address'],
                'createdAt' => date('Y-m-d H:i:s'),
                'updatedAt' => date('Y-m-d H:i:s'),
            ]);
        }
    }

    public function safeDown()
    {
        $this->truncateTable(Employee::tableName());
        $this->dropForeignKey('fk-employee-to-department', '{{%employee}}');
        $this->truncateTable(Department::tableName());
        $this->addForeignKey(
            'fk-employee-to-department',
            '{{%employee}}',
            'departmentId',
            '{{%department}}',
            'id',
            'SET NULL',
            'CASCADE'
        );
        echo "m180210_131539_insert_data_employee - reverted.\n";
    }
}
