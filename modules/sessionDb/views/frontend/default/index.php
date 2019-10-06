<?php

use app\modules\sessionDb\assets\SessionAsset;

/** @var $data array */

SessionAsset::register($this);
$this->title = 'Страница проверка сессий';

?>
<h4 class="page-header"><?= $this->title ?></h4>
<div class="row">
    <div class="col-xs-12 col-sm-4">
        <?= \yii\helpers\Html::input('text', 'keySession', '', ['class' => 'form-control keySession', 'placeholder' => 'Введите ключ сессии']) ?>
    </div>
    <div class="col-xs-12 col-sm-4">
        <?= \yii\helpers\Html::input('text', 'valueSession', '', ['class' => 'form-control valueSession', 'placeholder' => 'Введите значение сессии']) ?>
    </div>
    <div class="col-xs-12 col-sm-4"><button class="addSession btn btn-success">Добавить ключ значение сессии</button></div>
</div>
    <hr />
    <h4 class="page-header">Существующие сессии</h4>
<div class="row">
    <div class="сol-sm-12">
        <div class="all-data">
            <?= $this->render('_data', ['data' => $data]) ?>
        </div>
    </div>
</div>
