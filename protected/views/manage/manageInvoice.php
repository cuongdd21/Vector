<?php
/* @var $this LessonController */
/* @var $model Lesson */

require_once(dirname(__FILE__).'/../ModelDisplayHelper.php');
$this->breadcrumbs=array(
	'Lessons'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Lesson', 'url'=>array('index')),
	array('label'=>'Create Lesson', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#lesson-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<?php
	if (!isset($_GET['student_id']))
             throw new CHttpException('Need to provide student_id!');
?>
<h1>Invoice of <?php echo Student::model()->findByPk($_GET['student_id'])->name;?></h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'lesson-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>$model,
	'columns'=>array(
    'id',
                'number',
                'date_create',
		array('name'=>'total','header'=>'Total amount'),
		/*
		'end_week',
		'name',
		'group',
		'type',
		'status',
		'total',
		'subject_id',
		'price_id',
		'student_id',
		'lesson_notes',
		*/
         array('header'=>'Print Invoice',
        'class'=>'CLinkColumn',
        'label'=>'Preview',
        'urlExpression'=>'Yii::app()->createUrl("payment/viewInvoice",array("student_id"=>$data->student_id,"invoice_id"=>$data->id))',
        ),
         array('header'=>'Print Invoice',
        'class'=>'CLinkColumn',
        'label'=>'Print Now',
        'urlExpression'=>'Yii::app()->createUrl("payment/printInvoice",array("student_id"=>$data->student_id,"invoice_id"=>$data->id))',
        ),            
	),
)); ?>
