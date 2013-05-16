<?php
$baseUrl = Yii::app()->request->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerCssFile($baseUrl.'/css/schedule.css');
?>
<?php
/* @var $this FeedbackController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Feedbacks',
);

$this->menu=array(
	array('label'=>'Create Feedback', 'url'=>array('create')),

);
?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
        'template'=>"{items}\n{pager}",
)); ?>
