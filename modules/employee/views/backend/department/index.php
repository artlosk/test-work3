<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\employee\models\DepartmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Departments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Department', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            [
                'class' => \app\common\grid\HiddenColumn::class,
                'attribute' => 'hidden',
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