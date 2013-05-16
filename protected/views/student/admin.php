<?php
/* @var $this StudentController */
/* @var $model Student */

$this->breadcrumbs=array(
	'Students'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create Student', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#student-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Students</h1>


<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'student-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'name',
                'email',
		'contact',

        array('header'=>'Lesson',
        'class'=>'CLinkColumn',
        'label'=>'create',
        'urlExpression'=>'Yii::app()->createUrl("lesson/create",array("student_id"=>$data->id))',
        ),
                array('header'=>'View Lesson',
        'class'=>'CLinkColumn',
        'label'=>'view',
        'urlExpression'=>'Yii::app()->createUrl("lesson/admin",array("student_id"=>$data->id))',
        )
        ,  
                 array(
                        'header' => 'Total lessons',
                        'value' => 'count($data->lessons)',  //and it works for me. It's important to put the ''s out
                ),           
            array('header'=>'Attendance',
        'class'=>'CLinkColumn',
        'label'=>'view',
        'urlExpression'=>'Yii::app()->createUrl("manage/manageStudentAttendance",array("student_id"=>$data->id))',
        )
        ,
        array(
                        'header' => 'Invoice',
                        'value' => 'count($data->invoices)',  //and it works for me. It's important to put the ''s out
                ),
                     array('header'=>'View Invoice',
        'class'=>'CLinkColumn',
        'label'=>'view',
        'urlExpression'=>'Yii::app()->createUrl("manage/manageInvoice",array("student_id"=>$data->id,))',
        ),
		/*
		'parent_id',
		'school_id',
		'st_notes',
		*/
		array(
			'class'=>'CButtonColumn',
		),
     
	),
)); ?>
