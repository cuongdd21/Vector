
<?php  
  $baseUrl = Yii::app()->baseUrl; 
  $cs = Yii::app()->getClientScript();
  $cs->registerCssFile($baseUrl.'/css/schedule.css');
?>
<?php

/* @var $this ScheduleController */

$this->breadcrumbs=array(
	'Schedule',
);
?>
<p>
<?php
print_r($a);
echo $html;
	
?>
</p>
