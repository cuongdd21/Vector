<?php
/* @var $this LessonController */
/* @var $model Lesson */

$this->breadcrumbs=array(
	'Lessons'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Create Lesson', 'url'=>array('create')),
	array('label'=>'Update Lesson', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Lesson', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Lesson', 'url'=>array('admin')),
);
?>

<h1>View Lesson #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'term_id',
		'day',
		'slot',
		'staff_id',
		'start_week',
		'end_week',
		'name',
		'group',
		'type',
		'status',
		'total',
                'subject',
		'subject_id',
		'price_id',
		'student_id',
		'lesson_notes',
	),
)); ?>
