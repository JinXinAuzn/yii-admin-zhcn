<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this  yii\web\View */
/* @var $model jx\admin_zhcn\models\BizRule */
/* @var $form ActiveForm */
$form = ActiveForm::begin([
	'id' => $model->formName(),
	'options' => ['class' => 'form-horizontal'],
	'fieldConfig' => [
		'template' => '{label}<div class="col-sm-6">{input}</div><div class="col-sm-3">{hint}{error}</div>',
		'labelOptions' => ['class' => 'col-sm-3 control-label'],
		'inputOptions' => ['class' => 'form-control']
	],
]); ?>
<?= $form->field($model, 'name')->textInput(['maxlength' => 64]) ?>
<?= $form->field($model, 'className')->textInput() ?>
<div class="form-group text-center">
	<?= Html::submitButton($model->isNewRecord ? Yii::t('rbac-admin', 'Create') : Yii::t('rbac-admin', 'Update'),
		['class' => 'btn btn-success']) ?>
	<?= Html::a(Yii::t('rbac-admin', 'Return'), 'javascript:history.go(-1)', ['class' => 'btn btn-default']) ?>
</div>
<?php ActiveForm::end(); ?>

