<?php
use yii\bootstrap\Modal;
use yii\helpers\Html;
Modal::begin([
    'header' => Html::tag('h4', $this->title, ['class' => 'modal-title']),
    'id' => 'modal',
    'options' => [ 'tabindex' => ''],
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
]);
Modal::end();
