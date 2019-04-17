<?php

namespace jx\admin_zhcn\controllers;

use Yii;
use jx\admin_zhcn\models\Menu;
use jx\admin_zhcn\models\searchs\Menu as MenuSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use jx\admin_zhcn\components\Helper;

/**
 * MenuController implements the CRUD actions for Menu model.
 *
 * @author Au zn <690550322@qq.com>
 * @since Full version
 */
class MenuController extends BaseController
{
	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['post'],
				],
			],
		];
	}

	/**
	 * @description 菜单列表
	 * Lists all Menu models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new MenuSearch;
		$dataProvider = $searchModel->search(Yii::$app->request->getQueryParams());
		return $this->render('index', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);
	}

	/**
	 * @description 菜单详情
	 * Displays a single Menu model.
	 * @param  integer $id
	 * @return mixed
	 * @throws NotFoundHttpException
	 */
	public function actionView($id)
	{
		return $this->render('view', [
			'model' => $this->findModel($id),
		]);
	}

	/**
	 * @description 菜单创建
	 * Creates a new Menu model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Menu;
		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			Helper::invalidate();
			$this->showMessage('success', Yii::t('rbac-admin', 'Create Success'));
			return $this->redirect(['index']);
		} else {
			return $this->render('create', [
				'model' => $model,
			]);
		}
	}

	/**
	 * @description 菜单更新
	 * Updates an existing Menu model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param  integer $id
	 * @return mixed
	 * @throws NotFoundHttpException
	 */
	public function actionUpdate($id)
	{

		$model = $this->findModel($id);
		if ($model->menuParent) {
			$model->parent_name = $model->menuParent->name;
		}
		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			Helper::invalidate();
			$this->showMessage('success', Yii::t('rbac-admin', 'Update Success'));
			return $this->redirect(['index']);
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	/**
	 * @description 菜单删除
	 * Deletes an existing Menu model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param  integer $id
	 * @return mixed
	 * @throws NotFoundHttpException
	 * @throws \Throwable
	 * @throws \yii\db\StaleObjectException
	 */
	public function actionDelete($id)
	{
		$this->findModel($id)->delete();
		Helper::invalidate();
		$this->showMessage('danger', Yii::t('rbac-admin', 'Delete Success'));
		return $this->redirect(['index']);
	}

	/**
	 * Finds the Menu model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param  integer $id
	 * @return Menu the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Menu::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
