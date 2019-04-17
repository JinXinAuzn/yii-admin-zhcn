<?php
use yii\widgets\Breadcrumbs;
use \common\widgets\Alert;
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<?php if (isset($this->blocks['content-header'])) { ?>
		<?= $this->blocks['content-header'] ?>
	<?php } else { ?>
	<section class="content-header">
		<h1>
			<?php
			if ($this->title !== null) {
				echo \yii\helpers\Html::encode($this->title);
			} else {
				echo \yii\helpers\Inflector::camel2words(
					\yii\helpers\Inflector::id2camel($this->context->module->id)
				);
				echo ($this->context->module->id !== \Yii::$app->id) ? '<small>Module</small>' : '';
			}
			?>
		</h1>
		<?=
		Breadcrumbs::widget([
			'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []
		])
		?>
		<?php } ?>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- Your Page Content Here -->
		<?=Alert::widget()?>
		<?= $content ?>
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->

