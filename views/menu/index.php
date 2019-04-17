<?php

use jx\admin_zhcn\components\Helper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel jx\admin_zhcn\models\searchs\Menu */
$this->title = Yii::t('rbac-admin', 'Menus');
$this->params['breadcrumbs'][] = $this->title;
$_html = "<div class='summary'>符合搜索条件的数据共<strong class='text-danger'>{totalCount}</strong> 个" . (Yii::$app->request->queryParams ? Html::a('<u>' . '取消搜索' . '</u>', \yii\helpers\Url::to(['index']), ['class' => 'btn-search-cancel']) : '') . "</div>";
$_empty_html = "<div class='summary'>符合搜索条件的数据共<strong class='text-danger'>0</strong> 个" . (Yii::$app->request->queryParams ? Html::a('<u>' . '取消搜索' . '</u>', \yii\helpers\Url::to(['index']), ['class' => 'btn-search-cancel']) : '') . "</div>";
$_columns = [
	['class' => 'yii\grid\SerialColumn'],
	'name',
	[
		'attribute' => 'menuParent.name',
		'filter' => Html::activeTextInput($searchModel, 'parent_name', [
			'class' => 'form-control', 'id' => null
		]),
		'label' => Yii::t('rbac-admin', 'Parent'),
	],
	'route',
	'order',
	[
		"header" => "操作",
		'headerOptions' => ['rowspan' => "2", 'style' => 'vertical-align:middle'],
		'class' => 'yii\grid\ActionColumn',
		'template' => Helper::filterActionColumn('{view} {update} {delete}'),
		'contentOptions' => [],
		"buttons" => [
			"view" => function ($url, $model, $key) {
				return Html::a('<span class="glyphicon glyphicon-eye-open"></span> 查看', $url, ['class' => 'btn btn-xs btn-success']);
			},
			"update" => function ($url, $model, $key) {
				return Html::a('<span class="glyphicon glyphicon-pencil"></span> 编辑', $url, ['class' => 'btn btn-xs btn-warning']);
			},
			"delete" => function ($url, $model, $key) {
				return Html::a('<span class="glyphicon glyphicon-trash"></span> 删除', $url, [
					'class' => 'btn btn-xs btn-danger',
					'data' => [
						'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
						'method' => 'post',
					],
				]);
			}]
	],
]
?>
<?php if (Helper::checkRoute('create')): ?>
	<div class="well well-sm clearfix">
		<div class="pull-left">
			<?= Html::a('<i class="fa fa-plus"></i> ' . Yii::t('rbac-admin', 'Create Menu'), ['create'], ['class' => 'btn btn-sm btn-info']) ?>
		</div>
		<div class="pull-right">
		</div>
	</div>
<?php endif; ?>
<div class="list-table ibox panel-dep-edit">
	<!--    --><?php // echo $this->render('_search', ['model' => $searchModel]);  ?>
	<?php Pjax::begin(); ?>
	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'tableOptions' => ['class' => "text-center kv-grid-table table table-bordered table-striped kv-table-wrap"],
		'columns' => $_columns,
		'summary' => $_html,
		'emptyText' => $_empty_html,
	]); ?>
	<?php Pjax::end(); ?>
</div>
