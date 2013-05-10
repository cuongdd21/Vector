<?php
/* @var $this SessionController */
/* @var $data Session */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('attendance')); ?>:</b>
	<?php echo CHtml::encode($data->attendance); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('staff_id')); ?>:</b>
	<?php echo CHtml::encode($data->staff_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('students_id')); ?>:</b>
	<?php echo CHtml::encode($data->students_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lesson_id')); ?>:</b>
	<?php echo CHtml::encode($data->lesson_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('classroom_id')); ?>:</b>
	<?php echo CHtml::encode($data->classroom_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('day_id')); ?>:</b>
	<?php echo CHtml::encode($data->day_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('slot')); ?>:</b>
	<?php echo CHtml::encode($data->slot); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('session_notes')); ?>:</b>
	<?php echo CHtml::encode($data->session_notes); ?>
	<br />

	*/ ?>

</div>