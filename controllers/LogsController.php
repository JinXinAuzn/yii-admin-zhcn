<?php


namespace jx\admin_zhcn\controllers;

use jx\admin_zhcn\models\searchs\Logs;
use Yii;

/**
 * @author Au zn <690550322@qq.com>
 * @since Full version
 */
class LogsController extends BaseController
{
	/**
	 * @description 操作记录
	 * Lists all  Logs models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new Logs();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}
}
