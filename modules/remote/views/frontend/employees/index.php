<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */

$this->title = 'Страница получения данных о сотрудниках через API';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs(<<<JS
$(document).on('change', '#filter-form', function(e) {
    $.pjax({
        url: $('#filter-form').attr('action'),
        container: '#accordion',
        fragment: '#accordion',
        timeout: 4000,
        data: $('#filter-form').serializeArray(),
    });
});
JS
    , yii\web\View::POS_END);

?>
<div class="remote-employees-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3">
            <fieldset>
                <legend>Список отделов</legend>
                <?php Pjax::begin() ?>
                <?php if ($departmentProvider) : ?>
                    <ul>
                        <?php foreach ($departmentProvider->getModels() as $department) : ?>
                            <li><?= $department ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <?= yii\widgets\LinkPager::widget(['pagination' => $departmentProvider->getPagination(),]) ?>
                <?php Pjax::end() ?>
            </fieldset>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-9">
            <fieldset>
                <legend>Список всех сотрудников</legend>
                <?php Pjax::begin() ?>
                <?= Html::beginForm(['/remote/employees/index'], 'get', ['data-pjax' => true, 'id' => 'filter-form']) ?>
                <div class="row">
                    <div class="col-xs-12 col-md-4">
                        <?= Html::label('ФИО сотрудника') ?>
                        <?= Html::input('text', 'searchName', Yii::$app->request->get('searchName'), [
                            'placeholder' => 'ФИО сотрудника',
                            'class' => 'form-control'
                        ]); ?>
                    </div>
                    <div class="col-xs-12 col-md-4">
                        <?= Html::label('Отдел') ?>
                        <?= Html::dropDownList('searchDepartment', Yii::$app->request->get('searchDepartment'), $departmentList, [
                            'prompt' => 'Выберите отдел',
                            'class' => 'form-control'
                        ]); ?>
                    </div>
                    <div class="col-xs-12 col-md-4">
                        <?= Html::label('Статус') ?>
                        <?= Html::dropDownList('searchStatus', Yii::$app->request->get('searchStatus'), [
                            '1' => 'Назначен',
                            '0' => 'Освобожден',
                        ],
                            [
                                'prompt' => 'Выберите статус',
                                'class' => 'form-control'
                            ]); ?>
                    </div>
                </div>

                <div class="row" style="margin: 20px 0px; ">
                    <div class="pull-right">
                        <?= Html::submitButton('Найти', ['class' => 'btn btn-primary', 'name' => 'search']) ?>
                    </div>
                </div>

                <?= Html::endForm(); ?>
                <hr/>
                <div class="panel-group" id="accordion">
                    <?php if ($employeeProvider) : ?>

                        <?php //$i = 0;

                        ?>
                        <?php foreach ($employeeProvider->getModels() as $employee) : ?>
                            <?php
                            //$i++;
                            ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion"
                                           href="#collapse<?= $employee['id'] ?>">
                                            <?= $employee['name'] ?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse<?= $employee['id'] ?>"
                                     class="panel-collapse collapse <?php /*if($i == 1) echo 'in'; */ ?>in">
                                    <div class="panel-body">
                                        <div class="row">
                                            <?php if (isset($employee['department']) && isset($employee['department'])) : ?>
                                                <div class="col-xs-12 col-sm-6 col-md-4">
                                                    <p><strong>Отдел: </strong><?= $employee['department']['title'] ?>
                                                    </p>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($employee['pin'] !== null || $employee['pin'] != '') : ?>
                                                <div class="col-xs-12 col-sm-6 col-md-4">
                                                    <p><strong>Пин: </strong><?= $employee['pin'] ?></p>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($employee['status'] !== null || $employee['status'] != '') : ?>
                                                <div class="col-xs-12 col-sm-6 col-md-4">
                                                    <p>
                                                        <strong>Статус: </strong>
                                                        <?php if ($employee['status'] == 1) : ?>
                                                            <span>Назначен</span>
                                                        <?php else : ?>
                                                            <span>Освобожден</span>
                                                        <?php endif; ?>
                                                    </p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="row">
                                            <?php if ($employee['phone'] !== null || $employee['phone'] != '') : ?>
                                                <div class="col-xs-12 col-sm-6 col-md-4">
                                                    <p><strong>Телефон: </strong><?= $employee['phone'] ?></p>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($employee['address'] !== null || $employee['address'] != '') : ?>
                                                <div class="col-xs-12 col-sm-6 col-md-4">
                                                    <p><strong>Адрес: </strong><?= $employee['address'] ?></p>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ($employee['email'] !== null || $employee['pin'] != '') : ?>
                                                <div class="col-xs-12 col-sm-6 col-md-4">
                                                    <p><strong>Пин: </strong><?= $employee['pin'] ?></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <?= yii\widgets\LinkPager::widget(['pagination' => $employeeProvider->getPagination(),]) ?>
                    <?php endif; ?>
                </div>
                <?php Pjax::end(); ?>
            </fieldset>
        </div>
    </div>
</div>


