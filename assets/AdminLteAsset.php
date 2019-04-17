<?php

namespace jx\admin_zhcn\assets;


use yii\web\AssetBundle;

/**
 * @author Au zn <690550322@qq.com>
 * @since Full version
 */
class AdminLteAsset extends AssetBundle
{
	public $sourcePath = '@jx/admin_zhcn/web';
	public $css = [
		'css/admin/font-awesome.min.css',
		'css/admin/AdminLTE.min.css',
	];
	public $js = [
		'js/admin/adminlte.min.js',
	];
	public $depends = [
		'backend\assets\AppAsset'
	];
}
