<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model jx\admin_zhcn\models\Menu */

$this->title = Yii::t('rbac-admin', 'Update Menu') . ': ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'Menus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('rbac-admin', 'Update');
?>
<div class="list-table ibox panel-dep-edit">
    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
