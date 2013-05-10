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
?>
<h1>Manage Price</h1>
<?php 
$t = array();
foreach($model as $m)
{
    $t[] = CHtml::link($m->rate,array('manage/updatePrice/'.$m->id));
}

		echo "<table id='ttt1' class ='table1' border='1'>
			<tr>
				<th colspan ='3' scope='col'></th>
				<th scope='col'>Package Rates</th>
				<th scope='col'>Usual Rates</th>
			</tr>
                        <tr>
                                <td scope ='row'></td>
                                <td scope ='row'>YEAR</td>
                                <td scope ='row'></td>
                                <td scope ='row'> >5 sessions </td>
                                <td scope ='row'> <5 sessions </td>
                        </tr>
                        <tr>
                                <td scope ='row'>Junior Tutor</td>
                                <td scope ='row'>4 to 6</td>
                                <td scope ='row'> Group</td>
                                <td scope ='row'> $ $t[0] </td>
                                <td scope ='row'> $ $t[1] </td>
                        </tr>
                        <tr>
                                <td scope ='row'>Junior Tutor</td>
                                <td scope ='row'>4 to 9</td>
                                <td scope ='row'>Ind</td>
                                <td scope ='row'> $ $t[2] </td>
                                <td scope ='row'> $ $t[3] </td>
                        </tr>
                        <tr>
                                <td scope ='row'>Senior Tutor</td>
                                <td scope ='row'>7 to 12</td>
                                <td scope ='row'>Group</td>
                                <td scope ='row'> $ $t[4] </td>
                                <td scope ='row'> $ $t[5] </td>
                        </tr> 
                        <tr>
                                <td scope ='row'>Senior Tutor</td>
                                <td scope ='row'>10 to 12</td>
                                <td scope ='row'>Ind</td>
                                <td scope ='row'> $ $t[6] </td>
                                <td scope ='row'> $ $t[7] </td>
                        </tr>
                        </table>";
 

 ?>

