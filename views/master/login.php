<?php

use jx\admin_zhcn\assets\LoginAsset;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = '登录';
LoginAsset::register($this);
?>

	<!DOCTYPE html>
	<?php $this->beginPage() ?>
	<html lang="<?= Yii::$app->language ?>">
	<head>
		<meta charset="<?= Yii::$app->charset ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?= Html::csrfMetaTags() ?>
		<title><?= Html::encode($this->title) ?>_后台管理系统</title>
		<?php $this->head() ?>
	</head>
	<body class='hold-transition skin-custom'>
	<?php $this->beginBody() ?>
	<div id="transform">
		<div id="tranformBg"></div>
	</div>
	<div class="login-bg">
		<div class="login-box">
			<div class="menu clearfix">
				<h1>后台管理系统</h1>
				<?php
				$form = ActiveForm::begin([
					'id' => 'login-form',
					'fieldConfig' => [
						'options' => ['tag' => 'li'],
						'template' => '<span></span><div class="input">{input}</div>',
					],
				]);
				?>
				<ul>
					<?= $form->field($model, 'username')->input('text', ['placeholder' => '账号']) ?>
					<?= $form->field($model, 'password')->passwordInput(['placeholder' => '密码']) ?>
					<?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
						'captchaAction' => '/admin/master/captcha',
						'imageOptions' => ['class' => 'img-thumbnail'],
						'options' => ['class' => 'captchas', 'placeholder' => '验证码'],
						'template' => '{input}{image}',
					]) ?>
				</ul>
				<div class="button">
					<?= Html::submitButton('登录', ['name' => 'login-button']) ?>
				</div>
				<?php ActiveForm::end(); ?>
			</div>
		</div>
	</div>
	<?php $this->endBody() ?>
	</body>
	</html>
<?php
$js[] = 'FSS("transform", "tranformBg");';
$this->registerJs(implode("\n", $js));
?>
<?php $this->endPage() ?>
