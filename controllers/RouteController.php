<?php

namespace jx\admin_zhcn\controllers;

use Yii;
use jx\admin_zhcn\models\Route;
use yii\filters\VerbFilter;

/**
 * Description of RuleController
 *
 * @author Au zn <690550322@qq.com>
 * @since Full version
 */
class RouteController extends BaseController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'create' => ['post'],
                    'assign' => ['post'],
                    'remove' => ['post'],
                    'refresh' => ['post'],
                ],
            ],
        ];
    }
    /**
     * @description 路由列表
     * Lists all Route models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Route();
        return $this->render('index', ['routes' => $model->getRoutes()]);
    }

    /**
     * @description 路由创建
     * Creates a new AuthItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        Yii::$app->getResponse()->format = 'json';
        $routes = Yii::$app->getRequest()->post('route', '');
        $routes = preg_split('/\s*,\s*/', trim($routes), -1, PREG_SPLIT_NO_EMPTY);
        $model = new Route();
        $model->addNew($routes);
        return $model->getRoutes();
    }

    /**
     * @description 路由添加
     * Assign routes
     * @return array
     */
    public function actionAssign()
    {
        $routes = Yii::$app->getRequest()->post('routes', []);
        $model = new Route();
        $model->addNew($routes);
        Yii::$app->getResponse()->format = 'json';
        return $model->getRoutes();
    }

    /**
     * @description 路由删除
     * Remove routes
     * @return array
     */
    public function actionRemove()
    {
        $routes = Yii::$app->getRequest()->post('routes', []);
        $model = new Route();
        $model->remove($routes);
        Yii::$app->getResponse()->format = 'json';
        return $model->getRoutes();
    }

    /**
     * @description 路由刷新
     * Refresh cache
     * @return array|type
     */
    public function actionRefresh()
    {
        $model = new Route();
        $model->invalidate();
        Yii::$app->getResponse()->format = 'json';
        return $model->getRoutes();
    }
}
