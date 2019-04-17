<?php

namespace jx\admin_zhcn\controllers;


use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
/**
 * @author Au zn <690550322@qq.com>
 * @since Full version
 */
class BaseController extends Controller
{
	/**
	 * 消息
	 * @param $type
	 * @param $content
	 * @return
	 */
	public function showMessage($type, $content) {
		return Yii::$app->getSession()->setFlash($type, $content);
	}
	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'except' => ['login', 'captcha'],
				'rules' => [
					[
						'allow' => true,
						'roles' => ['@'],
					],
				],
			],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['post'],
					'logout' => ['post'],
					'activate' => ['post'],
				],
			],
		];
	}
}
