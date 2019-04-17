<?php

use jx\admin_zhcn\components\Helper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel jx\admin_zhcn\models\searchs\Master */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('rbac-admin', 'Users');
$this->params['breadcrumbs'][] = $this->title;
$_html = "<div class='summary'>符合搜索条件的数据共<strong class='text-danger'>{totalCount}</strong> 个" . (Yii::$app->request->queryParams ? Html::a('<u>' . '取消搜索' . '</u>', \yii\helpers\Url::to(['index']), ['class' => 'btn-search-cancel']) : '') . "</div>";
$_empty_html = "<div class='summary'>符合搜索条件的数据共<strong class='text-danger'>0</strong> 个" . (Yii::$app->request->queryParams ? Html::a('<u>' . '取消搜索' . '</u>', \yii\helpers\Url::to(['index']), ['class' => 'btn-search-cancel']) : '') . "</div>";
$_columns = [
	['class' => 'yii\grid\SerialColumn'],
	'username',
	'email:email',
	[
		'attribute' => 'created_at',
		'format' => ['date', 'php:Y-m-d'],
	],
	[
		'attribute' => 'status',
		'value' => function ($model) {
			return $model->status == 0 ? Yii::t('rbac-admin', 'Inactive') : Yii::t('rbac-admin', 'Active');
		},
		'filter' => [
			0 => Yii::t('rbac-admin', 'Inactive'),
			10 => Yii::t('rbac-admin', 'Active')
		],
		'filterInputOptions' => ['class' => 'form-control input-md'],
	],
	[
		"header" => "操作",
		'headerOptions' => ['rowspan' => "2", 'style' => 'vertical-align:middle'],
		'class' => 'yii\grid\ActionColumn',
		'template' => Helper::filterActionColumn('{view} {update} {activate} {delete}'),
		'buttons' => [
			"view" => function ($url, $model, $key) {
				return Html::a('<span class="glyphicon glyphicon-eye-open"></span> 查看', $url, ['class' => 'btn btn-xs btn-success']);
			},
			"update" => function ($url, $model, $key) {
				return Html::a('<span class="glyphicon glyphicon-edit"></span> 编辑', $url, ['class' => 'btn btn-xs btn-warning']);
			},
			"delete" => function ($url, $model, $key) {
				return Html::a('<span class="glyphicon glyphicon-trash"></span> 删除', $url, [
					'class' => 'btn btn-xs btn-danger',
					'data' => [
						'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
						'method' => 'post',
					],
				]);
			},
			'activate' => function ($url, $model) {
				$title = $model->status == 10 ? ' 禁用' : ' 启用';
				$options = [
					'class' => 'btn btn-xs btn-primary',
					'data-confirm' => Yii::t('rbac-admin', 'Are you sure you want to revise it?'),
					'data-method' => 'post',
					'data-pjax' => '0',
				];

				return Html::a("<span class='glyphicon glyphicon-pencil'></span>$title", $url, $options);
			}
		]
	],
]
?>
<?php if (Helper::checkRoute('create')): ?>
	<div class="well well-sm clearfix">
		<div class="pull-left">
			<?= Html::a('<i class="fa fa-plus"></i> ' . Yii::t('rbac-admin', 'Create'), ['create'], ['class' => 'btn btn-sm btn-info']) ?>
		</div>
		<div class="pull-right">
		</div>
	</div>
<?php endif; ?>
<div class="list-table list-table ibox panel-dep-edit">
	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'tableOptions' => ['class' => "text-center kv-grid-table table table-bordered table-striped kv-table-wrap"],
		'columns' => $_columns,
		'summary' => $_html,
		'emptyText' => $_empty_html,
	]); ?>
</div>
