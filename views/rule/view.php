<?php

use jx\admin_zhcn\components\Helper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var jx\admin_zhcn\models\AuthItem $model
 */
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'Rules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="well well-sm clearfix">
	<div class="pull-left">
		<?php if(Helper::checkRoute('update')):?>
		<?= Html::a(Yii::t('rbac-admin', 'Update'), ['update', 'id' => $model->name], ['class' => 'btn btn btn-success']) ?>
		<?php endif;?>
		<?php if (Helper::checkRoute('delete')) {
			echo Html::a(Yii::t('rbac-admin', 'Delete'), ['delete', 'id' => $model->name], [
				'class' => 'btn btn-danger',
				'data-confirm' => Yii::t('rbac-admin', 'Are you sure to delete this item?'),
				'data-method' => 'post',
			]);
		}
		?>
	</div>
	<div class="pull-right">
	</div>
</div>
<div class="list-table list-table ibox panel-dep-edit">
	<?php
	echo DetailView::widget([
		'model' => $model,
		'options'=> ['class' => "text-center kv-grid-table table table-bordered table-striped kv-table-wrap"],
		'attributes' => [
			'name',
			'className',
		],
	]);
	?>
</div>
