<?php
/* @var $this StaffController */
/* @var $model Staff */
?>

<h1>Update Paygrade <?php echo $model->id; ?></h1>

<?php
/* @var $this StaffController */
/* @var $model Staff */
/* @var $form CActiveForm */
require_once(dirname(__FILE__).'/../../components/FormHelper.php');

?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'price-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

        <div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
        <div class="row">
		<?php echo $form->labelEx($model,'session'); ?>
		<?php echo $form->textField($model,'session'); ?>
		<?php echo $form->error($model,'session'); ?>
	</div>
       <div class="row">
		<?php echo $form->labelEx($model,'upfront'); ?>
		<?php echo $form->textField($model,'upfront'); ?>
		<?php echo $form->error($model,'upfront'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>