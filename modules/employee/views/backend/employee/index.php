<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\employee\models\EmployeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Employees';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Employee', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'filter' => $searchModel::getDepartmentList(),
                'attribute' => 'departmentId',
                'value' => function ($model) {
                    return $model->getDepartmentTitle();
                }
            ],
            'pin',
            'name',
            'email:email',
            [
                'filter' => $searchModel::getStatusList(),
                'attribute' => 'status',
                'value' => function ($model) {
                    return $model->getStatus();
                },
            ],
            [
                'class' => \app\common\grid\DatePickerColumn::class,
                'attribute' => 'createdAt',
            ],
            [
                'class' => \app\common\grid\DatePickerColumn::class,
                'attribute' => 'updatedAt',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
