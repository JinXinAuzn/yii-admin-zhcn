<?php

namespace jx\admin_zhcn\components;

use yii\rbac\Rule;

/**
 * Description of GuestRule
 *
 * @author Au zn <690550322@qq.com>
 * @since Full version
 */
class GuestRule extends Rule
{
    /**
     * @inheritdoc
     */
    public $name = 'guest_rule';

    /**
     * @inheritdoc
     */
    public function execute($user, $item, $params)
    {
        return $user->getIsGuest();
    }
}
