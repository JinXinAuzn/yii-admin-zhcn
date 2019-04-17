<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \jx\admin_zhcn\models\Master */

?>
<div class="list-table ibox panel-dep-edit">
	<?= Html::errorSummary($model) ?>
	<?php $form = ActiveForm::begin([
		'id' => $model->formName(),
		'options' => ['class' => 'form-horizontal'],
		'fieldConfig' => [
			'template' => '{label}<div class="col-sm-6">{input}</div><div class="col-sm-3">{hint}{error}</div>',
			'labelOptions' => ['class' => 'col-sm-3 control-label'],
			'inputOptions' => ['class' => 'form-control']
		],
	]); ?>
	<?= $form->field($model, 'username') ?>
	<?= $form->field($model, 'email') ?>
	<?= $form->field($model, 'password_hash')->passwordInput(['value'=>'']) ?>
	<div class="form-group text-center">
		<?= Html::submitButton($model->isNewRecord ? Yii::t('rbac-admin', 'Create') : Yii::t('rbac-admin', 'Update'),
			['class' => 'btn btn-success']) ?>
		<?= Html::a(Yii::t('rbac-admin', 'Return'), 'javascript:history.go(-1)', ['class' => 'btn btn-default']) ?>
	</div>
	<?php ActiveForm::end(); ?>
</div>
