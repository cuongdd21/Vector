<?php
	require_once(dirname(__FILE__).'/../ModelDisplayHelper.php');
    
    $s = explode(',',$students_id);
    
    
    
    
    
  echo '<b>Mark Attendance</b>'
 ?>   
    <div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'manage-session-attendance',
	'enableAjaxValidation'=>false,
)); ?>


<?php
    echo $message;
    $attend = $session->attendance;
?>


	<div class="row">
  <?php  
  if ($attend =='')
  { $a = true;}
  else
  {
  if ($attend[0]==1) {$a=true;} else {$a=false;}
  }
  
  echo '<br/>';echo '<b><br/>Staff:<br/></b>';echo CHtml::CheckBox('staff',$a, array(
                                        'value'=>'on','uncheckValue'=>'off'
                                        ));echo getStaffText($staff_id); ?>
 <?php
	echo '<b><br/>Student:</b>';
    for ($i=0;$i<count($s);$i++)
    {
          if ($attend =='')
  { $a = true;}
  else{
          if ($attend[$i+1]==1) {$a=true;} else {$a=false;}
          }
        $j=$i+1;
        echo '<br/>';echo CHtml::CheckBox('student_'.$j,$a, array(
                                        'value'=>'on','uncheckValue'=>'off'
                                        )); 
       echo getStudentText($s[$i]);
       
    }
?>

	</div>


	<div class="row buttons" style="margin:auto;">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
    'type'=>'submit',
    'buttonType'=>'submit',
    'label'=>'Save',
    'block'=>false,
)); ?>
        
                
	</div>

<?php $this->endWidget(); ?>
