<?php
/* @var $this ManageController */
require_once(dirname(__FILE__).'/../../components/FormHelper.php');
$this->breadcrumbs=array(
	'Manage',
);
?>
<?php
/* @var $this TermController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Terms',
);

$this->menu=array(
	array('label'=>'Create Term', 'url'=>array('create')),
	array('label'=>'Manage Term', 'url'=>array('admin')),
);
?>

<h1>Terms</h1>



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
		<?php $this->widget('bootstrap.widgets.TbButton', array(
    'type'=>'submit',
    'buttonType'=>'submit',
    'label'=>'Save',
    'block'=>false,
)); ?>
	</div>
    <?php
    echo "<p style='color:green';>$message</p>";
?>
<?php $this->endWidget(); ?>

</div><!-- form -->
