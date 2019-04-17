<?php

namespace jx\admin_zhcn\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Html;

/**
 * This is the model class for table "logs".
 *
 * @property int $id 自编号
 * @property int $type 日志类型
 * @property int $master_id 操作人编号
 * @property string $ip 操作者ip
 * @property string $route 路由
 * @property string $remark 备注
 * @property int $created_at 添加时间
 * @property int $updated_at 更新时间
 */
class Logs extends ActiveRecord
{

	//日志类型 1-操作日志 2-登陆日志
	const ONE = 1;
	const TWO = 2;

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%logs}}';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['master_id', 'created_at', 'type', 'updated_at'], 'integer'],
			[['master_id', 'remark'], 'required'],
			[['remark', 'ip'], 'string'],
			[['route'], 'string', 'max' => 255],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => Yii::t('rbac-admin', 'ID'),
			'type' => Yii::t('rbac-admin', 'Log Type'),
			'master_id' => Yii::t('rbac-admin', 'Master'),
			'ip' => Yii::t('rbac-admin', 'Ip'),
			'route' => Yii::t('rbac-admin', 'Route'),
			'remark' => Yii::t('rbac-admin', 'Description'),
			'created_at' => Yii::t('rbac-admin', 'Created At'),
			'updated_at' => Yii::t('rbac-admin', 'Updated At'),
		];
	}

	public function behaviors()
	{
		return [
			TimestampBehavior::className()
		];
	}

	public static function getType()
	{
		return [
			self::ONE => Yii::t('rbac-admin', 'Logs'),
			self::TWO => Yii::t('rbac-admin', 'login logout'),
		];
	}

	/**
	 * 获取状态样式
	 * @return array
	 */
	public static function getTypeCss()
	{
		return [
			self::ONE => Html::tag('span', Yii::t('rbac-admin', 'Logs'), ['class' => 'badge badge-success']),
			self::TWO => Html::tag('span', Yii::t('rbac-admin', 'login logout'), ['class' => 'badge badge-warning']),
		];
	}

	/**
	 * 关联管理员表
	 */
	public function getMaster()
	{
		return $this->hasOne(Master::className(), ['id' => 'master_id']);
	}
}
