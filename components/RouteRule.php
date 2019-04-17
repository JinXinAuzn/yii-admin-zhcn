<?php

namespace jx\admin_zhcn\components;

use Yii;
use yii\rbac\Rule;

/**
 * RouteRule Rule for check route with extra params.
 *
 * @author Au zn <690550322@qq.com>
 * @since Full version
 */
class RouteRule extends Rule
{
    const RULE_NAME = 'route_rule';

    /**
     * @inheritdoc
     */
    public $name = self::RULE_NAME;

    /**
     * @inheritdoc
     */
    public function execute($user, $item, $params)
    {
        $routeParams = isset($item->data['params']) ? $item->data['params'] : [];
        foreach ($routeParams as $key => $value) {
            if (!array_key_exists($key, $params) || $params[$key] != $value) {
                return false;
            }
        }
        return true;
    }
}
