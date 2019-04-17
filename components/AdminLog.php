<?php

namespace jx\admin_zhcn\components;

use jx\admin_zhcn\models\Logs;
use yii\helpers\StringHelper;
use Yii;
use yii\base\Model;
use yii\helpers\Url;

/**
 * @author Au zn <690550322@qq.com>
 * @since Full version
 */
class AdminLog extends Model
{
	/**
	 * 获取当前登录人员
	 */
	public static function getMasterName(){
		return Yii::$app->user->identity->username;
	}
	/**
	 * 操作日志 增加
	 * @param $event
	 */
	public static function afterInsert($event){
		if (!empty($event->changedAttributes) && $event->sender->className() != 'jx\admin_zhcn\models\Logs') {
			$id = isset($event->sender->oldAttributes['id']) ? $event->sender->oldAttributes['id'] : '--';
			$description = self::getMasterName() . '添加了' . $event->sender->className() . '模型数据【id:' . $id . '】';
			self::EventLog($description);
		}
	}
	/**
	 * 操作日志 修改
	 * @param $event
	 * */
	public static function afterUpdate($event){
		if (!empty($event->changedAttributes) && $event->sender->className() != 'jx\admin_zhcn\models\Logs') {
			$id = isset($event->sender->oldAttributes['id']) ? $event->sender->oldAttributes['id'] : '--';
			$description = self::getMasterName() . '修改了' . $event->sender->className() . '模型数据【id:' . $id . '】';
			self::EventLog($description);
		}
	}
	/**
	 * 操作日志 删除
	 * @param $event
	 * */
	public static function afterDelete($event){
		if ($event->sender->className() != 'jx\admin_zhcn\models\Logs') {
			$id = isset($event->sender->attributes['id']) ? $event->sender->attributes['id'] : '--';
			$description = self::getMasterName() . '删除了' . $event->sender->className() . '模型数据【id:' . $id . '】';
			self::EventLog($description);
		}
	}
	/**
	 * 添加操作记录
	 * @param $description
	 */
	public static function EventLog($description){
		$route = Url::to();
		$userId = Yii::$app->user->id;
		$data = [
			'route' => StringHelper::truncate(urldecode($route), 200),
			'type' => Logs::ONE,
			'remark' => substr($description, 0, 250),
			'ip' => Yii::$app->request->userIP,
			'master_id' => $userId
		];
		$model = new Logs();
		$model->setAttributes($data);
		$model->save();
	}
	/**
	 * 登录登出
	 * @param int $type 1-登录 2-退出
	 * @return bool
	 */
	public static function addLog($type)
	{
		$mgs = $type == 1 ? '登录' : '退出';
		$description = self::getMasterName() . '进行了' . $mgs . '操作';
		$route = Url::to();
		$userId = Yii::$app->user->id;
		$data = [
			'route' => substr(urldecode($route), 0, 250),
			'type' => Logs::TWO,
			'remark' => $description,
			'ip' => Yii::$app->request->userIP,
			'master_id' => $userId
		];
		$model = new Logs();
		$model->setAttributes($data);
		$model->save();
		return true;
	}
}
