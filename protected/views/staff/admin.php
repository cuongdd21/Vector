<?php
/* @var $this StaffController */
/* @var $model Staff */

$this->breadcrumbs=array(
	'Staffs'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create Staff', 'url'=>array('create')),
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

<h1>Manage Staffs</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button'));

?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'staff-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'display_name',
		'name',
		'contact',
		'email',
        array('header'=>'Attendance',
        'class'=>'CLinkColumn',
        'label'=>'view',
        'urlExpression'=>'Yii::app()->createUrl("manage/manageStaffAttendance",array("staff_id"=>$data->id))',
        ),
        array('header'=>'Payslip',
        'class'=>'CLinkColumn',
        'label'=>'view',
        'urlExpression'=>'Yii::app()->createUrl("manage/managePayslip",array("staff_id"=>$data->id))',
        ),
            
		/*
		'TFN',
		'BSB',
		'AN',
		'paygrade_id',
		'notes',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
