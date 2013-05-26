<?php
/* @var $this SessionController */
/* @var $model Session */
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($baseUrl.'/js/bootstrap-confirm.js'); 
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