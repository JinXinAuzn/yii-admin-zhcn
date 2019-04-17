<?php
//
//namespace backend\assets;
//
//use yii\web\AssetBundle;
//
///**
// * @author Au zn <690550322@qq.com>
// * @since Full version
// */
//class AppAsset extends AssetBundle
//{
//	public $basePath = '@webroot';
//	public $baseUrl = '@web';
//	public $css = [
//	];
//	public $js = [
//	];
//	public $depends = [
//		'yii\web\YiiAsset',
//		'yii\bootstrap\BootstrapPluginAsset',
//	];
//
//	/**
//	 * use backend\assets\AppAsset;
//	 * AppAsset::addScript($this,'/js/main.js');
//	 * 定义按需加载JS方法，注意加载顺序在最后
//	 * @param $view
//	 * @param $js_file
//	 */
//	public static function addJs($view, $js_file)
//	{
//		$view->registerJsFile($js_file, [AppAsset::className(), 'depends' => 'backend\assets\AppAsset']);
//	}
//
//	/**
//	 * use backend\assets\AppAsset;
//	 * AppAsset::addScript($this,'/js/main.css');
//	 * 定义按需加载css方法，注意加载顺序在最后
//	 * @param $view
//	 * @param $css_file
//	 */
//	public static function addCss($view, $css_file)
//	{
//		$view->registerCssFile($css_file, [AppAsset::className(), 'depends' => 'backend\assets\AppAsset']);
//	}
//}
