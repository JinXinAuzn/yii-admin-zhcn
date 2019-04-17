yii2-admin-zhcn
==========
Can be directly to development

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run
- master
```
composer require --prefer-dist jinxinauzn/yii2-admin-zhcn "dev-master"
```


or add
- master
```
"jinxinauzn/yii2-admin-zhcn": "dev-master"
```


to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :
notice Due to the  with  conflict So only jQuery_2*
```php
return [
    ...
    'aliases' => [
        '@jx/admin_zhcn' => 'path/to/your/extracted',
        // for example: '@jx/admin_zhcn' => '@backend/runtime/tmp-extensions/yii2-admin-zhcn',
        ...
    ]
];
```

In the main
-----

```php
return [
	'id' => 'app-backend',
	'basePath' => dirname(__DIR__),
	'language' => 'zh-CN',
	'defaultRoute' => '/admin/master/index',
	'homeUrl' => ['/'],
	'layout' => '@jx/admin_zhcn/views/layouts/main.php',
	'controllerNamespace' => 'backend\controllers',
	'bootstrap' => ['log'],
	'modules' => [
		'admin' => [
			'class' => 'jx\admin_zhcn\Module',
			'layout' => 'main',
		],
	],
	'components' => [
		'request' => [
			'csrfParam' => '_csrf-backend',
		],
		'user' => [
			'identityClass' => 'jx\admin_zhcn\models\Master',
			'enableAutoLogin' => true,
			'loginUrl' => ['/admin/master/login'],
			'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
		],
		'session' => [
			// this is the name of the session cookie used for login on the backend
			'name' => 'advanced-backend',
		],
		'log' => [
			'traceLevel' => YII_DEBUG ? 3 : 0,
			'targets' => [
				[
					'class' => 'yii\log\FileTarget',
					'levels' => ['error', 'warning'],
					'except' => [
						'yii\web\HttpException:401',
						'yii\web\HttpException:404',
					],
				],
			],
		],
		'i18n' => [
			'translations' => [
				'*' => [
					'class' => 'yii\i18n\PhpMessageSource',
					'basePath' => '@jx/admin_zhcn/messages',
				],
			],
		],
		'authManager' => [
			'class' => 'yii\rbac\DbManager', // use 'yii\rbac\DbManager'
		],
		'assetManager' => [
			'assetMap' => [
				'jquery.js' => '@web/js/jquery.js', // jquery v3.2.1 和 jQuery UI 1.11.4 版本冲突 @https://stackoverflow.com/questions/37914869/jquery-ui-error-f-getclientrects-is-not-a-function
				'jquery.min.js' => '@web/js/jquery.min.js',
			]
		],
		'errorHandler' => [
			'errorAction' => 'site/error',
		],
		'urlManager' => [
			//用于表明urlManager是否启用URL美化功能，在Yii1.1中称为path格式URL，
			// Yii2.0中改称美化。
			// 默认不启用。但实际使用中，特别是产品环境，一般都会启用。
			"enablePrettyUrl" => true,
			// 是否启用严格解析，如启用严格解析，要求当前请求应至少匹配1个路由规则，
			// 否则认为是无效路由。
			// 这个选项仅在 enablePrettyUrl 启用后才有效。
			"enableStrictParsing" => false,
			// 是否在URL中显示入口脚本。是对美化功能的进一步补充。
			"showScriptName" => false,
			// 指定续接在URL后面的一个后缀，如 .html 之类的。仅在 enablePrettyUrl 启用时有效。
			"suffix" => "",
			'rules' => [
				"<controller:\w+>/<action:\w+>" => "<controller>/<action>",
				"<module:\w+>/<controller:\w+>/<action:\w+>" => "<module>/<controller>/<action>",
				"<controller:\w+>/<action:\w+>/<id:\d+>" => "<controller>/<action>",
				"<controller:\w+>/<action:\w+>/<id:\w+>" => "<controller>/<action>",
				"<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>" => "<module>/<controller>/<action>",
				"<module:\w+>/<controller:\w+>/<action:\w+>/<id:\w+>" => "<module>/<controller>/<action>",
			],
		],
	],

	/*'aliases' => [
		'@jx/admin_zhcn' => '@backend/runtime/tmp-extensions/yii2-admin-zhcn',
	],*/

	'as access' => [
		'class' => 'jx\admin_zhcn\components\AccessControl',
		'allowActions' => [
			'admin/master/captcha',
			'admin/master/login',
			'admin/master/logout',
//			'*'
		]
	],
	'params' => $params,
	'on beforeRequest' => function ($event) {
		\yii\base\Event::on(\yii\db\BaseActiveRecord::className(), \yii\db\BaseActiveRecord::EVENT_AFTER_UPDATE, ['jx\admin_zhcn\components\AdminLog', 'afterUpdate']);
		\yii\base\Event::on(\yii\db\BaseActiveRecord::className(), \yii\db\BaseActiveRecord::EVENT_AFTER_INSERT, ['jx\admin_zhcn\components\AdminLog', 'afterInsert']);
		\yii\base\Event::on(\yii\db\BaseActiveRecord::className(), \yii\db\BaseActiveRecord::EVENT_AFTER_DELETE, ['jx\admin_zhcn\components\AdminLog', 'afterDelete']);
	},
];
```
