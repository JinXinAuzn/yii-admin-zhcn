<?php

namespace jx\admin_zhcn\components;

use Yii;
use yii\caching\Cache;
use yii\db\Connection;
use yii\di\Instance;
use yii\helpers\ArrayHelper;
use yii\rbac\ManagerInterface;

/**
 * Configs
 * Used to configure some values. To set config you can use [[\yii\base\Application::$params]]
 *
 * ```
 * return [
 *
 *     'jx.admin_zhcn.configs' => [
 *         'db' => 'customDb',
 *         'menuTable' => '{{%admin_menu}}',
 *         'cache' => [
 *             'class' => 'yii\caching\DbCache',
 *             'db' => ['dsn' => 'sqlite:@runtime/admin-cache.db'],
 *         ],
 *     ]
 * ];
 * ```
 *
 * or use [[\Yii::$container]]
 *
 * ```
 * Yii::$container->set('jx\admin_zhcn\components\Configs',[
 *     'db' => 'customDb',
 *     'menuTable' => 'admin_menu',
 * ]);
 * ```
 *
 * @author Au zn <690550322@qq.com>
 * @since Full version
 */
class Configs extends \yii\base\Object
{
    const CACHE_TAG = 'jx.admin_zhcn';

    /**
     * @var ManagerInterface .
     */
    public $authManager = 'authManager';

    /**
     * @var Connection Database connection.
     */
    public $db = 'db';

    /**
     * @var Connection Database connection.
     */
    public $userDb = 'db';

    /**
     * @var Cache Cache component.
     */
    public $cache = 'cache';

    /**
     * @var integer Cache duration. Default to a hour.
     */
    public $cacheDuration = 3600;

    /**
     * @var string Menu table name.
     */
    public $menuTable = '{{%menu}}';

    /**
     * @var string Menu table name.
     */
    public $userTable = '{{%master}}';

    /**
     * @var integer Default status master signup. 10 mean active.
     */
    public $defaultUserStatus = 10;

    /**
     * @var boolean If true then AccessControl only check if route are registered.
     */
    public $onlyRegisteredRoute = false;

    /**
     * @var boolean If false then AccessControl will check without Rule.
     */
    public $strict = true;

    /**
     * @var array
     */
    public $options;

    /**
     * @var array|false
     */
    public $advanced;

    /**
     * @var self Instance of self
     */
    private static $_instance;
    private static $_classes = [
        'db' => 'yii\db\Connection',
        'userDb' => 'yii\db\Connection',
        'cache' => 'yii\caching\Cache',
        'authManager' => 'yii\rbac\ManagerInterface',
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        foreach (self::$_classes as $key => $class) {
            try {
                $this->{$key} = empty($this->{$key}) ? null : Instance::ensure($this->{$key}, $class);
            } catch (\Exception $exc) {
                $this->{$key} = null;
                Yii::error($exc->getMessage());
            }
        }
    }

    /**
     * Create instance of self
     * @return static
     */
    public static function instance()
    {
        if (self::$_instance === null) {
            $type = ArrayHelper::getValue(Yii::$app->params, 'jx.admin_zhcn.configs', []);
            if (is_array($type) && !isset($type['class'])) {
                $type['class'] = static::className();
            }

            return self::$_instance = Yii::createObject($type);
        }

        return self::$_instance;
    }

    public static function __callStatic($name, $arguments)
    {
        $instance = static::instance();
        if ($instance->hasProperty($name)) {
            return $instance->$name;
        } else {
            if (count($arguments)) {
                $instance->options[$name] = reset($arguments);
            } else {
                return array_key_exists($name, $instance->options) ? $instance->options[$name] : null;
            }
        }
    }

    /**
     * @return Connection
     */
    public static function db()
    {
        return static::instance()->db;
    }

    /**
     * @return Connection
     */
    public static function userDb()
    {
        return static::instance()->userDb;
    }

    /**
     * @return Cache
     */
    public static function cache()
    {
        return static::instance()->cache;
    }

    /**
     * @return ManagerInterface
     */
    public static function authManager()
    {
        return static::instance()->authManager;
    }
    /**
     * @return integer
     */
    public static function cacheDuration()
    {
        return static::instance()->cacheDuration;
    }

    /**
     * @return string
     */
    public static function menuTable()
    {
        return static::instance()->menuTable;
    }

    /**
     * @return string
     */
    public static function userTable()
    {
        return static::instance()->userTable;
    }

    /**
     * @return string
     */
    public static function defaultUserStatus()
    {
        return static::instance()->defaultUserStatus;
    }

    /**
     * @return boolean
     */
    public static function onlyRegisteredRoute()
    {
        return static::instance()->onlyRegisteredRoute;
    }

    /**
     * @return boolean
     */
    public static function strict()
    {
        return static::instance()->strict;
    }
}
