<?php
/* @var $this StaffController */
/* @var $model Staff */
/* @var $form CActiveForm */
require_once(dirname(__FILE__).'/../../components/FormHelper.php');

?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'staff-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); 
    	$model->term_id = Term::model()->getLatest()->id;?>

	<div class="row">
		<?php echo $form->labelEx($model,'term_id'); ?>
		<?php echo $form->dropDownList($model,'term_id',getTermList()); ?>
		<?php echo $form->error($model,'term_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'display_name'); ?>
		<?php echo $form->textField($model,'display_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'display_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'contact'); ?>
		<?php echo $form->textField($model,'contact',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'contact'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'TFN'); ?>
		<?php echo $form->textField($model,'TFN',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'TFN'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'BSB'); ?>
		<?php echo $form->textField($model,'BSB',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'BSB'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'AN'); ?>
		<?php echo $form->textField($model,'AN',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'AN'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'paygrade_id'); ?>
		<?php echo $form->dropDownList($model,'paygrade_id',getPayGradeList()); ?>
		<?php echo $form->error($model,'paygrade_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notes'); ?>
		<?php echo $form->textArea($model,'notes',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'notes'); ?>
	</div>

	<div class="row buttons">
		<?php
        $text=''; 
        if($model->isNewRecord)
        {
            $text = 'Create';
        }
        else
        {
            $text='Save';
        }
        
        ?>
        		<?php $this->widget('bootstrap.widgets.TbButton', array(
    'type'=>'submit',
    'buttonType'=>'submit',
    'label'=>$text,
    'block'=>false,
)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->