<?php
use jx\admin_zhcn\components\MenuHelper;
use jx\admin_zhcn\components\Menu;

/**
 * @param $menu
 * @return array
 */
$callback = function($menu){
	$data = json_decode($menu['data'], true);
	$items = $menu['children'];
	$return = [
		'label' => $menu['name'],
		'url' => [$menu['route']],
	];
	//处理我们的配置
	if ($data) {
		//visible
		isset($data['visible']) && $return['visible'] = $data['visible'];
		//icon
		isset($data['icon']) && $data['icon'] && $return['icon'] = $data['icon'];
		//other attribute e.g. class...
		$return['options'] = $data;
	}
	//没配置图标的显示默认图标
	(!isset($return['icon']) || !$return['icon']) && $return['icon'] = 'fa fa-list';
	$items && $return['items'] = $items;
	return $return;
};
?>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar fixed">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<div class="user-panel">
			<div class="image">
			</div>
			<div class="info">
				<p><?= isset(Yii::$app->user->identity->username) ? Yii::$app->user->identity->username : 'admin' ?></p>
			</div>
		</div>
		<?= Menu::widget([
			'options' => ['class' => 'sidebar-menu'],
			'items' => MenuHelper::getAssignedMenu(Yii::$app->user->id,null,$callback),
		]);?>
	</section>
	<!-- /.sidebar -->
</aside>
