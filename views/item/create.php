<?php
/* @var $this yii\web\View */
/* @var $model jx\admin_zhcn\models\AuthItem */

$context = $this->context;
$labels = $context->labels();
$this->title = Yii::t('rbac-admin', 'Create ' . $labels['Item']);
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', $labels['Items']), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="list-table ibox panel-dep-edit">
    <?=
    $this->render('_form', [
        'model' => $model,
    ]);
    ?>

</div>
