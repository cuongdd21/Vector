<?php
/* @var $this LessonController */
/* @var $model Lesson */
/* @var $form CActiveForm */
require_once(dirname(__FILE__).'/../../components/FormHelper.php');
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'lesson-form',
	'enableAjaxValidation'=>false,
)); ?>

<?php
	if(isset($_GET['student_id']))
    {
        $model->student_id =$_GET['student_id']; 
    }
?>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model, $price); ?>
<?php
	$model->term_id = Term::model()->getLatest()->id;
?>
	<div class="row">
		<?php echo $form->labelEx($model,'term_id'); ?>
		<?php echo $form->dropDownList($model,'term_id',getTermList()); ?>
		<?php echo $form->error($model,'term_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'day'); ?>
		<?php echo $form->dropDownList($model,'day',getDayList()); ?>
		<?php echo $form->error($model,'day'); ?>
	</div>
	<div class="row">
        <?php echo CHtml::link('Slot List','#',array('class'=>'search-button')); ?>
            <div class="search-form" style="display:none">
            <?php $this->renderPartial('/manage/manageSlot'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'slot'); ?>
		<?php echo $form->dropDownList($model,'slot',getSlotListFull()); ?>
		<?php echo $form->error($model,'slot'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'staff_id'); ?>
		<?php echo $form->dropDownList($model,'staff_id',getStaffList()); ?>
		<?php echo $form->error($model,'staff_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'start_week'); ?>
		<?php echo $form->dropDownList($model,'start_week',getWeekList()); ?>
		<?php echo $form->error($model,'start_week'); ?>
                <?php echo $form->labelEx($model,'end_week'); ?>
		<?php echo $form->dropDownList($model,'end_week',getWeekList()); ?>
		<?php echo $form->error($model,'end_week'); ?>
	</div>

	<div class="row">

	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'group'); ?>
		<?php echo $form->dropDownList($model,'group',getYesNo()); ?>
		<?php echo $form->error($model,'group'); ?>
	</div>

        <div class="row">
        <?php echo CHtml::label('Package','');?>
        <?php echo CHtml::dropDownList('pricePackage', 'P', 
              array('P' => 'Package', 'U' => 'Usual')
              );
        ?>
            <?php echo CHtml::label('Group','');?>
        <?php echo CHtml::dropDownList('priceGroup', 'I', 
              array('G' => 'Group', 'I' => 'Individual')
              );
        ?>  
                        <?php echo CHtml::label('Cetificate','');?>
        <?php echo CHtml::dropDownList('priceDegree', 'J', 
              array('J' => 'Junior', 'S' => 'Senior')
              );
        ?>  
        </div>
	<div class="row">
        <?php echo CHtml::link('Price List','#',array('class'=>'search-button')); ?>
            <div class="search-form" style="display:none">
            <?php $this->renderPartial('/manage/managePrice',array(
                    'model'=>$price,
            )); ?>
	</div>
        </div>
	<div class="row">
		<?php echo $form->labelEx($model,'student_id'); ?>
		<?php echo $form->dropDownList($model,'student_id',getStudentList()); ?>
		<?php echo $form->error($model,'student_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lesson_notes'); ?>
		<?php echo $form->textArea($model,'lesson_notes',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'lesson_notes'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->