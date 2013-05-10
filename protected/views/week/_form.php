<?php
/* @var $this WeekController */
/* @var $model Week */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'week-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'week_no'); ?>
		<?php echo $form->textField($model,'week_no'); ?>
		<?php echo $form->error($model,'week_no'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'term_id'); ?>
		<?php echo $form->textField($model,'term_id'); ?>
		<?php echo $form->error($model,'term_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->