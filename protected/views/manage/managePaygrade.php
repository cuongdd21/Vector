<?php
/* @var $this StaffController */
/* @var $model Price */

$this->breadcrumbs=array(
	'Prices'=>array('index'),
	'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#staff-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<?php 
require_once( dirname(__FILE__) . '/../../components/ScheduleHelper.php');
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerCssFile($baseUrl . '/css/attendance.css');
?>
<h1>Manage Paygrade</h1>
<?php 
$t = array();
$s = array();
$b = array();
$n = array();
$count = count($model);
foreach($model as $m)
{
    $d = $m->session - $m->upfront;
    $t[] = CHtml::link($m->upfront,array('manage/updatePayGrade/'.$m->id));
    $b[] = CHtml::link($d,array('manage/updatePayGrade/'.$m->id));
    $s[] = CHtml::link($m->session,array('manage/updatePayGrade/'.$m->id));
    $n[] = CHtml::link($m->name,array('manage/updatePayGrade/'.$m->id));
}
                echo "<div id= 'table'>";
		echo "<table id='ttt1' class ='table1' border='1'>
			<tr>
				<th scope='col'> Paygrade</th>
				<th scope='col'>Session Rates</th>
				<th scope='col'>Upfront</th>
                                <th scope='col'>Bonus</th>
			</tr>";
                 for($i=0; $i<$count; $i++)
                 {
                     echo "<tr>
                                <td scope ='row'>$n[$i]</td>
                                <td scope ='row'>$s[$i]</td>
                                <td scope ='row'>$t[$i]</td>
                                <td scope ='row'>$b[$i]</td>
                         </tr>";
                 }
                  echo"</table>";
                  echo"</div>";
 ?>

