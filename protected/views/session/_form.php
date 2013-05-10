<?php
/* @var $this SessionController */
/* @var $model Session */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'session-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'attendance'); ?>
		<?php echo $form->textArea($model,'attendance',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'attendance'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'staff_id'); ?>
		<?php echo $form->textField($model,'staff_id'); ?>
		<?php echo $form->error($model,'staff_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'students_id'); ?>
		<?php echo $form->textArea($model,'students_id',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'students_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lesson_id'); ?>
		<?php echo $form->textField($model,'lesson_id'); ?>
		<?php echo $form->error($model,'lesson_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'classroom_id'); ?>
		<?php echo $form->textField($model,'classroom_id'); ?>
		<?php echo $form->error($model,'classroom_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'day_id'); ?>
		<?php echo $form->textField($model,'day_id'); ?>
		<?php echo $form->error($model,'day_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'slot'); ?>
		<?php echo $form->textField($model,'slot'); ?>
		<?php echo $form->error($model,'slot'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'session_notes'); ?>
		<?php echo $form->textArea($model,'session_notes',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'session_notes'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->