<?php
/* @var $this ManageController */
require_once(dirname(__FILE__).'/../../components/FormHelper.php');
$this->breadcrumbs=array(
	'Manage',
);
require_once(dirname(__FILE__).'/../ModelDisplayHelper.php');
?>

<p>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'manage-form',
	'enableAjaxValidation'=>false,
)); ?>


<?php

    $student = 1;
    
?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day')); ?>:</b>
	<?php echo CHtml::encode($data->getDayText()); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('slot')); ?>:</b>
	<?php echo CHtml::encode($data->slot); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('staff_id')); ?>:</b>
	<?php echo CHtml::encode($data->getStaffText()); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('start_week')); ?>:</b>
	<?php echo CHtml::encode($data->start_week); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('end_week')); ?>:</b>
	<?php echo CHtml::encode($data->end_week); ?>
    
	<br />
    <?php
	$count = count($data->students);
    for ($i=0;$i<$count;$i++)
    {
        echo '<b>Student '.($i+1).':</b>';
    
        echo CHtml::encode(getStudentText($data->students[$i]->student_id));
            echo '<br/>';
    }
    
    
?>

	<br />

	<div class="row">
		Select more Student to enroll to this lesson:
		<?php echo CHtml::dropDownList('student',$student,getStudentList()) ?>

	</div>
<?php

?>

	<div class="row buttons">
    <?php
        
        if (!$message)
        echo CHtml::submitButton('Save');
        else echo $message;
        ?>
          
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
</p>
