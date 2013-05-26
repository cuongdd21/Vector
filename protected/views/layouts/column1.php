<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main');
Yii::app()->bootstrap->register();
Yii::app()->clientScript->registerCoreScript('jquery'); 
Yii::app()->clientScript->registerCoreScript('jquery.ui'); ?>
<div id="content">
	<?php echo $content; ?>
</div><!-- content -->
<?php $this->endContent(); ?>