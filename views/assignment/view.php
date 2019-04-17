<?php

use jx\admin_zhcn\assets\AnimateAsset;
use jx\admin_zhcn\components\Helper;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\YiiAsset;

/* @var $this yii\web\View */
/* @var $model jx\admin_zhcn\models\Assignment */
/* @var $fullnameField string */

$userName = $model->{$usernameField};
if (!empty($fullnameField)) {
    $userName .= ' (' . ArrayHelper::getValue($model, $fullnameField) . ')';
}
$userName = Html::encode($userName);

$this->title = Yii::t('rbac-admin', 'Assignment') . ' : ' . $userName;

$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'Assignments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $userName;

AnimateAsset::register($this);
YiiAsset::register($this);
$opts = Json::htmlEncode([
    'items' => $model->getItems(),
]);
$this->registerJs("var _opts = {$opts};");
$this->registerJs($this->render('_script.js'));
$animateIcon = ' <i class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></i>';
?>
<div class="list-table list-table ibox panel-dep-edit">
    <div class="row">
        <div class="col-sm-5">
            <input class="form-control search" data-target="available"
                   placeholder="<?=Yii::t('rbac-admin', 'Search for available');?>">
            <select multiple size="20" class="form-control list" data-target="available">
            </select>
        </div>
        <div class="col-sm-1">
            <br><br>
	        <?php if(Helper::checkRoute('assign')):?>
            <?=Html::a('&gt;&gt;' . $animateIcon, ['assign', 'id' => (string) $model->id], [
			    'class' => 'btn btn-success btn-assign',
			    'data-target' => 'available',
			    'title' => Yii::t('rbac-admin', 'Assign'),
			]);?>
	        <?php endif;?>
	        <br><br>
	        <?php if(Helper::checkRoute('revoke')):?>
            <?=Html::a('&lt;&lt;' . $animateIcon, ['revoke', 'id' => (string) $model->id], [
			    'class' => 'btn btn-danger btn-assign',
			    'data-target' => 'assigned',
			    'title' => Yii::t('rbac-admin', 'Remove'),
			]);?>
	        <?php endif;?>
        </div>
        <div class="col-sm-5">
            <input class="form-control search" data-target="assigned"
                   placeholder="<?=Yii::t('rbac-admin', 'Search for assigned');?>">
            <select multiple size="20" class="form-control list" data-target="assigned">
            </select>
        </div>
    </div>
</div>
