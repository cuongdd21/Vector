<?php
/* @var $this SessionController */
/* @var $model Session */
/* @var $form CActiveForm */
require_once(dirname(__FILE__).'/../../components/FormHelper.php');
require_once(dirname(__FILE__).'/../../components/ScheduleHelper.php');
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/bootstrap-confirm.js'); 
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'session-form',
	'enableAjaxValidation'=>false,
)); ?>

  		<?php echo '<br/>';  
          $this->widget('bootstrap.widgets.TbButton', array(
            
    'buttonType'=>'link',
    'type'=>'info',
    'label'=>'Mark Attendance',
    'url'=>Yii::app()->createUrl('manage/manageSessionAttendance',array('session_id'=>$model->id)),
    'block'=>false,
)); ?>
    		<?php $this->widget('bootstrap.widgets.TbButton', array(
            
    'buttonType'=>'link',
    'type'=>'danger',
    'label'=>'Delete this Session',
    'url'=>Yii::app()->createUrl('session/delete/',array('id'=>$model->id)),
    'block'=>false,
    'htmlOptions'=>array('id'=>'confirmButton','data-confirm'=>'This Session will be permenently deleted, Are you Sure?'),
));   ?>

<br/>

<?php
echo '<br/>';  
     $week_new = $model->day->week->week_no;
     $day_new = $model->day->day_no;
     echo '<b>Week:</b><br/>'.CHtml::dropDownList('weeklist', $week_new,getWeekList());
     
     echo '<br/><b>Day:</b></br/>'.CHtml::dropDownList('daylist', $day_new,getDayList());
     
     
     // print the slot info

     $rt = getRoomTime($model);
          $room_new = $rt['room'];
     $time_new = $rt['time'];
     echo '<br/><b>Room:</b><br/>'.CHtml::dropDownList('roomlist', $room_new,getRoomList());
     
     echo '<br/><b>Time:</b><br/>'.CHtml::dropDownList('timelist', $time_new,getTimeList());  


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
		<?php echo $form->labelEx($model,'session_notes'); ?>
		<?php echo $form->textArea($model,'session_notes',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'session_notes'); ?>
	</div>
    	<div class="row buttons" style="margin:auto;">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
    'type'=>'submit',
    'buttonType'=>'submit',
    'label'=>'Save',
    'block'=>false,
)); ?>

        
                <br/>
                
                <br/>
	</div>


<?php $this->endWidget(); ?>

</div><!-- form -->