<?php
/* @var $this SessionController */
/* @var $model Session */
/* @var $form CActiveForm */
require_once(dirname(__FILE__).'/../../components/FormHelper.php');
require_once(dirname(__FILE__).'/../../components/ScheduleHelper.php');
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'session-form',
	'enableAjaxValidation'=>false,
)); ?>

<?php
	echo CHtml::link('Mark Attendance',array('manage/manageSessionAttendance','session_id'=>$model->id));
?>


	<p class="note">Fields with <span class="required">*</span> are required.</p>
<?php

     $week_new = $model->day->week->week_no;
     $day_new = $model->day->day_no;
     echo CHtml::dropDownList('weeklist', $week_new,getWeekList());
     echo CHtml::dropDownList('daylist', $day_new,getDayList());  
     



?>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'staff_id'); ?>
<?php echo $form->dropDownList($model,'staff_id',getStaffList()); ?>
		<?php echo $form->error($model,'staff_id'); ?>
	</div>
	<div class="row">
		<?php echo '<b>Students</b><br/>' ?>
		<?php echo getSessionStudentsDisplay($model) ?>
	
	</div>






	<div class="row">
        <?php echo CHtml::link('Slot List','#',array('class'=>'search-button')); ?>
            <div class="search-form" style="display:none">
            <?php $this->renderPartial('/manage/manageSlot'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'slot'); ?>
		<?php echo $form->dropDownList($model,'slot',getSlotListFull()); ?>
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