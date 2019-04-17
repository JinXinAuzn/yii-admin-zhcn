<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use jx\admin_zhcn\models\Menu;
use yii\helpers\Json;
use jx\admin_zhcn\assets\AutocompleteAsset;

/* @var $this yii\web\View */
/* @var $model jx\admin_zhcn\models\Menu */
/* @var $form yii\widgets\ActiveForm */
AutocompleteAsset::register($this);
$opts = Json::htmlEncode([
	'menus' => Menu::getMenuSource(),
	'routes' => Menu::getSavedRoutes(),
]);
$this->registerJs("var _opts = $opts;");
$this->registerJs($this->render('_script.js'));
$form = ActiveForm::begin([
	'id' => $model->formName(),
	'options' => ['class' => 'form-horizontal'],
	'fieldConfig' => [
		'template' => '{label}<div class="col-sm-6">{input}</div><div class="col-sm-3">{hint}{error}</div>',
		'labelOptions' => ['class' => 'col-sm-3 control-label'],
		'inputOptions' => ['class' => 'form-control']
	],
]); ?>
<?= Html::activeHiddenInput($model, 'parent', ['id' => 'parent_id']); ?>
<?= $form->field($model, 'name')->textInput(['maxlength' => 128]) ?>
<?= $form->field($model, 'parent_name')->textInput(['id' => 'parent_name']) ?>
<?= $form->field($model, 'route')->textInput(['id' => 'route']) ?>
<?= $form->field($model, 'order')->input('number') ?>
<?= $form->field($model, 'data')->textarea(['rows' => 4]) ?>
<div class="form-group text-center">
	<?= Html::submitButton($model->isNewRecord ? Yii::t('rbac-admin', 'Create') : Yii::t('rbac-admin', 'Update'),
		['class' => 'btn btn-success']) ?>
	<?= Html::a(Yii::t('rbac-admin', 'Return'), 'javascript:history.go(-1)', ['class' => 'btn btn-default']) ?>
</div>
<?php ActiveForm::end(); ?>

