<?php

use jx\admin_zhcn\assets\AnimateAsset;
use jx\admin_zhcn\components\Helper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model jx\admin_zhcn\models\AuthItem */

$context = $this->context;
$labels = $context->labels();
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', $labels['Items']), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

AnimateAsset::register($this);
YiiAsset::register($this);
$opts = Json::htmlEncode([
	'items' => $model->getItems(),
]);
$this->registerJs("var _opts = {$opts};");
$this->registerJs($this->render('_script.js'));
$animateIcon = ' <i class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></i>';
?>
<div class="well well-sm clearfix">
	<div class="pull-left">
		<?php if (Helper::checkRoute('create')): ?>
			<?= Html::a(Yii::t('rbac-admin', 'Create'), ['create'], ['class' => 'btn btn-info']); ?>
		<?php endif; ?>
		<?php if (Helper::checkRoute('update')): ?>
			<?= Html::a(Yii::t('rbac-admin', 'Update'), ['update', 'id' => $model->name], ['class' => 'btn btn-success']); ?>
		<?php endif; ?>
		<?php if (Helper::checkRoute('delete')): ?>
			<?= Html::a(Yii::t('rbac-admin', 'Delete'), ['delete', 'id' => $model->name], [
				'class' => 'btn btn-danger',
				'data-confirm' => Yii::t('rbac-admin', 'Are you sure to delete this item?'),
				'data-method' => 'post',
			]); ?>
		<?php endif; ?>
		<?= Html::a(Yii::t('rbac-admin', 'Return'), 'javascript:history.go(-1)', ['class' => 'btn btn-default']) ?>
	</div>
	<div class="pull-right">
	</div>
</div>
<div class="list-table list-table ibox panel-dep-edit">
	<div class="row">
		<div class="col-sm-11">
			<?=
			DetailView::widget([
				'model' => $model,
				'options'=> ['class' => "text-center kv-grid-table table table-bordered table-striped kv-table-wrap"],
				'attributes' => [
					'name',
					'description:ntext',
					'ruleName',
					'data:ntext',
				],
				'template' => '<tr><th style="width:25%">{label}</th><td>{value}</td></tr>',
			]);
			?>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-5">
			<input class="form-control search" data-target="available"
			       placeholder="<?= Yii::t('rbac-admin', 'Search for available'); ?>">
			<select multiple size="20" class="form-control list" data-target="available"></select>
		</div>
		<div class="col-sm-1">
			<br><br>
			<?php if(Helper::checkRoute('assign')):?>
			<?= Html::a('&gt;&gt;' . $animateIcon, ['assign', 'id' => $model->name], [
				'class' => 'btn btn-success btn-assign',
				'data-target' => 'available',
				'title' => Yii::t('rbac-admin', 'Assign'),
			]); ?>
			<?php endif;?>
			<br><br>
			<?php if(Helper::checkRoute('assign')):?>
			<?= Html::a('&lt;&lt;' . $animateIcon, ['remove', 'id' => $model->name], [
				'class' => 'btn btn-danger btn-assign',
				'data-target' => 'assigned',
				'title' => Yii::t('rbac-admin', 'Remove'),
			]); ?>
			<?php endif;?>
		</div>
		<div class="col-sm-5">
			<input class="form-control search" data-target="assigned"
			       placeholder="<?= Yii::t('rbac-admin', 'Search for assigned'); ?>">
			<select multiple size="20" class="form-control list" data-target="assigned"></select>
		</div>
	</div>
</div>
