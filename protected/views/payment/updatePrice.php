<?php
/* @var $this StaffController */
/* @var $model Staff */
?>
<?php
/* @var $this LessonController */
/* @var $dataProvider CActiveDataProvider */


$this->menu=array(
	array('label'=>'manage Price', 'url'=>array('/payment/managePrice')),
	array('label'=>'Manage PayGrade', 'url'=>array('/payment/managePaygrade')),
);
?>
<h1>Update Price <?php echo $model->id; ?></h1>

<?php
/* @var $this StaffController */
/* @var $model Staff */
/* @var $form CActiveForm */
require_once(dirname(__FILE__).'/../../components/FormHelper.php');

?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'price-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

        <div class="row">
		<?php echo $form->labelEx($model,'rate'); ?>
		<?php echo $form->textField($model,'rate'); ?>
		<?php echo $form->error($model,'rate'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
</div>

<?php $this->endWidget(); ?>