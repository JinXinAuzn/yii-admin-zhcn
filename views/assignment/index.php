<?php

use jx\admin_zhcn\components\Helper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel jx\admin_zhcn\models\searchs\Assignment */
/* @var $usernameField string */
/* @var $extraColumns string[] */

$this->title = Yii::t('rbac-admin', 'Assignments');
$this->params['breadcrumbs'][] = $this->title;
$_html = "<div class='summary'>符合搜索条件的数据共<strong class='text-danger'>{totalCount}</strong> 个" . (Yii::$app->request->queryParams ? Html::a('<u>' . '取消搜索' . '</u>', \yii\helpers\Url::to(['index']), ['class' => 'btn-search-cancel']) : '') . "</div>";
$_empty_html = "<div class='summary'>符合搜索条件的数据共<strong class='text-danger'>0</strong> 个" . (Yii::$app->request->queryParams ? Html::a('<u>' . '取消搜索' . '</u>', \yii\helpers\Url::to(['index']), ['class' => 'btn-search-cancel']) : '') . "</div>";
$columns = [
	['class' => 'yii\grid\SerialColumn'],
	$usernameField,
];
if (!empty($extraColumns)) {
	$columns = array_merge($columns, $extraColumns);
}
$columns[] = [
	"header" => "操作",
	'headerOptions' => ['rowspan' => "2", 'style' => 'vertical-align:middle'],
	'class' => 'yii\grid\ActionColumn',
	'template' => Helper::filterActionColumn('{view}'),
	"buttons" => [
		"view" => function ($url, $model, $key) {
			return Html::a('<span class="glyphicon glyphicon-eye-open"></span> 分配权限', $url, ['class' => 'btn btn-xs btn-info activity-master-view']);
		}]
];
?>
<div class="list-table list-table ibox panel-dep-edit">
	<?php Pjax::begin(); ?>
	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'tableOptions' => ['class' => "text-center kv-grid-table table table-bordered table-striped kv-table-wrap"],
		'columns' => $columns,
		'summary' => $_html,
		'emptyText' => $_empty_html,
	]); ?>
	<?php Pjax::end(); ?>

</div>
