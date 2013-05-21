<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main');
Yii::app()->bootstrap->register(); ?>
<div id="content">
	<?php echo $content; ?>
</div><!-- content -->
<?php $this->endContent(); ?>