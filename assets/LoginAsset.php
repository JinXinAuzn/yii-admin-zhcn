<?php

namespace jx\admin_zhcn\assets;


use yii\web\AssetBundle;

/**
 * @author Au zn <690550322@qq.com>
 * @since Full version
 */
class LoginAsset extends AssetBundle
{
	public $sourcePath = '@jx/admin_zhcn/web';
	public $css = [
		'css/login/reset.css',
		'css/login/login.css',
	];
	public $js=[
		'js/login/FSS.js'
	];
	public $depends = [
		'yii\web\YiiAsset',
	];
}
