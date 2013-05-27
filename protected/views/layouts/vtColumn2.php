<?php 
/* author: Victor
 * site: vector
 * purpose: main layout for main area section
 */
?>
<?php $this->beginContent('//layouts/mainLogin');
Yii::app()->bootstrap->register();
Yii::app()->clientScript->registerCoreScript('jquery'); 
Yii::app()->clientScript->registerCoreScript('jquery.ui'); ?>

<div id="content">
	<?php echo $content; ?>
</div><!-- content -->
<?php $this->endContent(); ?>