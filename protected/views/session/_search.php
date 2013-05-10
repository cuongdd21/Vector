<?php
/* @var $this SessionController */
/* @var $model Session */
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
		<?php echo $form->label($model,'attendance'); ?>
		<?php echo $form->textArea($model,'attendance',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'staff_id'); ?>
		<?php echo $form->textField($model,'staff_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'students_id'); ?>
		<?php echo $form->textArea($model,'students_id',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lesson_id'); ?>
		<?php echo $form->textField($model,'lesson_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'classroom_id'); ?>
		<?php echo $form->textField($model,'classroom_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'day_id'); ?>
		<?php echo $form->textField($model,'day_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'slot'); ?>
		<?php echo $form->textField($model,'slot'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'session_notes'); ?>
		<?php echo $form->textArea($model,'session_notes',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->