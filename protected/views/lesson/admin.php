<?php
/* @var $this LessonController */
/* @var $model Lesson */

require_once(dirname(__FILE__).'/../ModelDisplayHelper.php');
$this->breadcrumbs=array(
	'Lessons'=>array('index'),
	'Manage',
);

$this->menu=array(


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
<h1>Manage Lessons</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php
	if (isset($_GET['student_id']))
    {
        $dataProvider = $model->search($_GET['student_id']);
    }
    else
    {
          $dataProvider = $model->search();
    }
?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'lesson-grid',
	'dataProvider'=>$dataProvider,
	'filter'=>$model,
	'columns'=>array(
            'id',
		array('name'=>'day','value'=>'getDayText2($data->day)'),
		'slot',
		array('name'=>'staff_id','value'=>'getStaffText($data->staff_id)'),
            array('header'=>'noOfStudent','value'=>'count($data->students)'),
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
                array('header'=>'Student',
        'class'=>'CLinkColumn',
        'label'=>'enroll more',
        'urlExpression'=>'Yii::app()->createUrl("manage/manageLessonGroup",array("lesson_id"=>$data->id,"student"=>$data->student_id,))',
        ),
         array('header'=>'Lesson',
        'class'=>'CLinkColumn',
        'label'=>'Delete this lesson',
        'urlExpression'=>'Yii::app()->createUrl("manage/manageLessonGroup",array("lesson_id"=>$data->id))',
        ),
		
	),
)); ?>
