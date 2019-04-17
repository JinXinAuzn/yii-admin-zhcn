<?php

/* @var $this yii\web\View */
/* @var $model jx\admin_zhcn\models\Menu */

$this->title = Yii::t('rbac-admin', 'Create master');
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'Master'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="list-table ibox panel-dep-edit">
    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
