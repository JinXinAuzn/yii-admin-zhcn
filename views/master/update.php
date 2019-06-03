<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model jx\admin_zhcn\models\Menu */

$this->title = Yii::t('rbac-admin', 'Update master');
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'Master'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('rbac-admin', 'Update');

 ?>
<div class="list-table ibox panel-dep-edit">
    <?php $form = ActiveForm::begin([
        'id' => $model->formName(),
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => '{label}<div class="col-sm-6">{input}</div><div class="col-sm-3">{hint}{error}</div>',
            'labelOptions' => ['class' => 'col-sm-3 control-label'],
            'inputOptions' => ['class' => 'form-control']
        ],
    ]); ?>
    <?= $form->field($model, 'oldPassword')->passwordInput() ?>
    <?= $form->field($model, 'newPassword')->passwordInput() ?>
    <?= $form->field($model, 'retypePassword')->passwordInput() ?>
    <div class="form-group text-center">
        <?= Html::submitButton(Yii::t('rbac-admin', 'Update'), ['class' => 'btn btn-success', 'name' => 'change-button']) ?>
        <?=Html::a(Yii::t('rbac-admin', 'Return'),'javascript:history.go(-1)', ['class' => 'btn btn-default'] )?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
