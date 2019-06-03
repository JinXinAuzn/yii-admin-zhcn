<?php

namespace jx\admin_zhcn\controllers;

use jx\admin_zhcn\components\AdminLog;
use Yii;
use jx\admin_zhcn\models\form\Login;
use jx\admin_zhcn\models\form\Signup;
use jx\admin_zhcn\models\form\ChangePassword;
use jx\admin_zhcn\models\Master;
use jx\admin_zhcn\models\searchs\Master as MasterSearch;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\base\UserException;
use yii\mail\BaseMailer;
use yii\captcha\CaptchaAction;

/**
 * @author Au zn <690550322@qq.com>
 * @since Full version
 */
class MasterController extends BaseController
{
	private $_oldMailPath;

	/*
		 * 验证码
		 * */
	public function actions()
	{
		return [
			'captcha' => [
				'class' => CaptchaAction::className(),
				'minLength' => 4,
				'maxLength' => 4,
				'backColor' => 0x00A17D,
				'foreColor' => 0xFFFFFF,
				'transparent' => FALSE,
			],
		];
	}

	/**
	 * @inheritdoc
	 * @throws BadRequestHttpException
	 */
	public function beforeAction($action)
	{
		if (parent::beforeAction($action)) {
			if (Yii::$app->has('mailer') && ($mailer = Yii::$app->getMailer()) instanceof BaseMailer) {
				/* @var $mailer BaseMailer */
				$this->_oldMailPath = $mailer->getViewPath();
				$mailer->setViewPath('@jx/admin_zhcn/mail');
			}
			return true;
		}
		return false;
	}

	/**
	 * @inheritdoc
	 */
	public function afterAction($action, $result)
	{
		if ($this->_oldMailPath !== null) {
			Yii::$app->getMailer()->setViewPath($this->_oldMailPath);
		}
		return parent::afterAction($action, $result);
	}

	/**
	 * @description 管理员列表
	 * Lists all Master models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new MasterSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * @description 管理员详情
	 * Displays a single Master model.
	 * @param integer $id
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
	 * @description 管理员删除
	 * Deletes an existing Master model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 * @throws NotFoundHttpException
	 * @throws \Throwable
	 * @throws \yii\db\StaleObjectException
	 */
	public function actionDelete($id)
	{
		$this->findModel($id)->delete();
		$this->showMessage('danger', Yii::t('rbac-admin', 'Delete Success'));
		return $this->redirect(['index']);
	}

	/**
	 * @description 管理员登陆
	 * Login
	 * @return string
	 */
	public function actionLogin()
	{
		if (!Yii::$app->getUser()->isGuest) {
			return $this->goHome();
		}
		$model = new Login();
		if ($model->load(Yii::$app->getRequest()->post()) && $model->login()) {
			AdminLog::addLog(1);
			return $this->goBack();
		} else {
			return $this->renderPartial('login', [
				'model' => $model,
			]);
		}
	}

	/**
	 * @description 管理员登出
	 * Logout
	 * @return string
	 */
	public function actionLogout()
	{
		AdminLog::addLog(2);
		Yii::$app->getUser()->logout();
		return $this->goHome();
	}

	/**
	 * @description 管理员创建
	 * @return string
	 */
	public function actionCreate()
	{
        $model = new Signup();
        if ($model->load(Yii::$app->getRequest()->post())) {
            if ($user = $model->signup()) {
                $this->showMessage('success',Yii::t('rbac-admin', 'Create Success'));
                return $this->redirect(['index']);
            }
        }
		return $this->render('create', [
			'model' => $model,
		]);
	}

	/**
	 * @description 管理员修改
	 * @return string
	 */
	public function actionUpdate()
	{
        $model = new ChangePassword();
        if ($model->load(Yii::$app->getRequest()->post()) && $model->change()) {
            $this->showMessage('success',Yii::t('rbac-admin', 'Update Success'));
            return $this->redirect(['index']);
        }
		return $this->render('update', [
			'model' => $model,
		]);
	}

	/**
	 * @description 管理员状态修改
	 * Activate new master
	 * @return \yii\web\Response
	 * @throws UserException
	 */
	public function actionActivate()
	{
		/* @var $user Master */
		$user = $this->findModel();
		if ($user->status == Master::STATUS_INACTIVE) {
			$user->status = Master::STATUS_ACTIVE;
			if ($user->save()) {
				return $this->redirect(['index']);
			} else {
				$errors = $user->firstErrors;
				throw new UserException(reset($errors));
			}
		} else {
			$user->status = Master::STATUS_INACTIVE;
			$user->save();
		}
		return $this->redirect(['index']);
	}

	/**
	 * Finds the Master model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @return Master the loaded model
	 */
	protected function findModel()
	{
		$id=Yii::$app->request->get('id');
		if (($model = Master::findOne($id)) !== null) {
		} else {
			$model=new Master();
		}
		return $model;
	}
}
