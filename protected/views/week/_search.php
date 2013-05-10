<?php
/* @var $this WeekController */
/* @var $model Week */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'week_no'); ?>
		<?php echo $form->textField($model,'week_no'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'term_id'); ?>
		<?php echo $form->textField($model,'term_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->