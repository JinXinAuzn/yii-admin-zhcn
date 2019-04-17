<?php
use yii\helpers\Html;
?>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark fixed">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li class="active">
<?= Html::a('admin', '#control-sidebar-home-tab', ['data-toggle' => 'tab']) ?>
        </li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane active" id="control-sidebar-home-tab">
        </div><!-- /.tab-pane -->
    </div>
</aside><!-- /.control-sidebar -->
<div class="control-sidebar-bg"></div>
