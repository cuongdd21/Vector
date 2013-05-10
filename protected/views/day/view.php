<?php
/* @var $this DayController */
/* @var $model Day */

$this->breadcrumbs=array(
	'Days'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Day', 'url'=>array('index')),
	array('label'=>'Create Day', 'url'=>array('create')),
	array('label'=>'Update Day', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Day', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Day', 'url'=>array('admin')),
);
?>

<h1>View Day #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'day_no',
		'date',
		'week_id',
	),
)); ?>
