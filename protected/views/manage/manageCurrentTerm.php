<?php
/* @var $this ManageController */
require_once(dirname(__FILE__).'/../../components/FormHelper.php');
$this->breadcrumbs=array(
	'Manage',
);
?>

<p>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'manage-form',
	'enableAjaxValidation'=>false,
)); ?>




	<div class="row">
		Current Term:
		<?php echo CHtml::dropDownList('term',$term,getTermList()) ?>

	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Save'); ?>
	</div>
<?php
    echo "<p style ='color:red;'> $message </p>";
?>
<?php $this->endWidget(); ?>

</div><!-- form -->
</p>
