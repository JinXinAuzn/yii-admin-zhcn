<?php

namespace jx\admin_zhcn\controllers;

use Yii;

/**
 * DefaultController
 *
 * @author Au zn <690550322@qq.com>
 * @since Full version
 */
class DefaultController extends BaseController
{

	/**
	 * @description 文档首页
	 * Action index
	 * @param string $page
	 * @return string|\yii\console\Response|\yii\web\Response
	 */
    public function actionIndex($page = 'README.md')
    {
        if (strpos($page, '.png') !== false) {
            $file = Yii::getAlias("@jx/admin_zhcn/{$page}");
            return Yii::$app->getResponse()->sendFile($file);
        }
        return $this->render('index', ['page' => $page]);
    }
}
