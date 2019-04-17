<?php
use yii\helpers\Html;
?>
<!-- Main Header -->
<header class="main-header fixed">
    <!-- Logo -->
	<?= Html::a(Html::tag('span',Yii::t('rbac-admin','Admin_name'), ['class' => 'logo-mini']) . Html::tag('span',  Yii::t('rbac-admin','Backend_name'), ['class' => 'logo-lg']), Yii::$app->homeUrl, ['class' => 'logo']) ?>
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <?= Html::a(Html::tag('span', 'Toggle navigation', ['class' => 'sr-only']), '#', ['class' => 'sidebar-toggle', 'data-toggle' => 'offcanvas', 'role' => 'button']); ?>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <?= Html::a(Html::tag('span', isset(Yii::$app->user->identity->username) ? Yii::$app->user->identity->username : 'admin', ['class' => 'hidden-xs']), '#', ['class' => 'dropdown-toggle', 'data-toggle' => 'dropdown']) ?>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <p>
                                <?= isset(Yii::$app->user->identity->username) ? Yii::$app->user->identity->username : 'admin' ?>
	                            <small class="text-muted"><?=Yii::t('rbac-admin','OutTime')?> : <?=date('Y-m-d') ?></small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                            </div>
                            <div class="pull-right">
	                            <?= Html::a(Yii::t('rbac-admin','Logout'), ['/admin/master/logout'], ['class' => 'btn btn-default btn-flat', 'data-method' => 'post']) ?>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>

