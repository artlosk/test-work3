<?php

namespace app\modules\employee\models;
use yii\helpers\ArrayHelper;

/**
 * This is the ActiveQuery class for [[Department]].
 *
 * @see Department
 */
class DepartmentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Department[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Department|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param int $hidden
     * @return $this
     */
    public function hidden($hidden = Department::HIDDEN_NO)
    {
        return $this->andWhere([Department::tableName() . '.[[hidden]]' => $hidden]);
    }

    /**
     * @return array
     */
    public function asDropDown()
    {
        return ArrayHelper::map($this->hidden()->asArray()->all(), 'id', 'title');
    }
}
