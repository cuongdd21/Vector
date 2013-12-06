<?php
/* @var $this WeekController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Weeks',
);

$this->menu=array(
	array('label'=>'Create Week', 'url'=>array('create')),
	array('label'=>'Manage Week', 'url'=>array('admin')),
);
?>

<h1>Weeks</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
