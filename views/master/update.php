<?php

/* @var $this yii\web\View */
/* @var $model jx\admin_zhcn\models\Menu */

$this->title = Yii::t('rbac-admin', 'Update master');
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'Master'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('rbac-admin', 'Update');
?>
<div class="list-table ibox panel-dep-edit">
    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
