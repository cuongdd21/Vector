<?php
/* @var $this TermController */
/* @var $model Term */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'term-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'start_time'); ?>
		<?php echo $form->textField($model,'start_time'); ?>mm/dd/yyyy
		<?php echo $form->error($model,'start_time'); ?>
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