<?php

namespace app\modules\employee\models;

use Yii;
use app\common\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "employee".
 *
 * @property integer $id
 * @property integer $departmentId
 * @property string $pin
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property integer $status
 * @property string $createdAt
 * @property string $updatedAt
 *
 * @property Department $department
 */
class Employee extends \yii\db\ActiveRecord
{

    const STATUS_YES = 1;
    const STATUS_NO = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%employee}}';
    }

    /**
     * @return array
     */
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public function behaviors()
    {
        return [
            'TimestampBehavior' => [
                'class' => TimestampBehavior::class,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['departmentId', 'status'], 'integer'],
            [['pin', 'name', 'email'], 'required'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['pin'], 'string', 'max' => 4],
            [['pin'], 'number'],
            [['name'], 'string', 'max' => 128],
            [['email', 'address'], 'string', 'max' => 256],
            [['email'], 'email'],
            [['phone'], 'string', 'max' => 16],
            [['departmentId'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['departmentId' => 'id']],
            [['status'], 'in', 'range' => array_keys(self::getStatusList())],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'departmentId' => 'Отдел',
            'pin' => 'ПИН',
            'name' => 'ФИО',
            'email' => 'Email',
            'phone' => 'Телефон',
            'address' => 'Адрес',
            'status' => 'Статус',
            'createdAt' => 'Создано',
            'updatedAt' => 'Обновлено',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'departmentId']);
    }

    /**
     * List of available Department
     * @return array
     * @throws NotFoundHttpException
     */
    public static function getDepartmentList()
    {
        return Department::find()->asDropDown();
    }

    /**
     * @return null|string
     */
    public function getDepartmentTitle()
    {
        return is_null($this->department) ? null : $this->department->title;
    }

    /**
     * @inheritdoc
     * @return EmployeeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EmployeeQuery(get_called_class());
    }

    /**
     * @return array
     */
    public static function getStatusList()
    {
        return [
            self::STATUS_YES => 'Назначен', //Module::t('modules', TEXT)
            self::STATUS_NO => 'Освобожден', //Module::t('modules', TEXT)
        ];
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return ArrayHelper::getValue(self::getStatusList(), $this->status);
    }

}
