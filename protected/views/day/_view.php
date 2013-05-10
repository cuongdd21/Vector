<?php
/* @var $this DayController */
/* @var $data Day */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day_no')); ?>:</b>
	<?php echo CHtml::encode($data->day_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('week_id')); ?>:</b>
	<?php echo CHtml::encode($data->week_id); ?>
	<br />


</div>