<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use jx\admin_zhcn\components\RouteRule;
use jx\admin_zhcn\assets\AutocompleteAsset;
use yii\helpers\Json;
use jx\admin_zhcn\components\Configs;

/* @var $this yii\web\View */
/* @var $model jx\admin_zhcn\models\AuthItem */
/* @var $form yii\widgets\ActiveForm */

$context = $this->context;
$labels = $context->labels();
$rules = Configs::authManager()->getRules();
unset($rules[RouteRule::RULE_NAME]);
$source = Json::htmlEncode(array_keys($rules));
$js = <<<JS
    $('#rule_name').autocomplete({
        source: $source,
    });
JS;
AutocompleteAsset::register($this);
$this->registerJs($js);
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
<?= $form->field($model, 'description')->textarea(['rows' => 2]) ?>
<?= $form->field($model, 'ruleName')->textInput(['id' => 'rule_name']) ?>
<?= $form->field($model, 'data')->textarea(['rows' => 6]) ?>
<div class="form-group text-center">
	<?= Html::submitButton($model->isNewRecord ? Yii::t('rbac-admin', 'Create') : Yii::t('rbac-admin', 'Update'),
		['class' => 'btn btn-success', 'name' => 'submit-button']) ?>
	<?= Html::a(Yii::t('rbac-admin', 'Return'), 'javascript:history.go(-1)', ['class' => 'btn btn-default']) ?>
</div>
<?php ActiveForm::end(); ?>

