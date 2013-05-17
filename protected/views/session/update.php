<?php
/* @var $this SessionController */
/* @var $model Session */

$this->breadcrumbs=array(
	'Sessions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(

);
?>

<h1>Update Session </h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>