<?php
/* @var $this LogEventController */
/* @var $model LogEvent */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'log-event-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_email'); ?>
		<?php echo $form->textArea($model,'user_email',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'user_email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'event_id'); ?>
		<?php echo $form->textField($model,'event_id'); ?>
		<?php echo $form->error($model,'event_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'info_id'); ?>
		<?php echo $form->textField($model,'info_id'); ?>
		<?php echo $form->error($model,'info_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'info_title'); ?>
		<?php echo $form->textArea($model,'info_title',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'info_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'company_id'); ?>
		<?php echo $form->textField($model,'company_id'); ?>
		<?php echo $form->error($model,'company_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'company_name'); ?>
		<?php echo $form->textArea($model,'company_name',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'company_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_create'); ?>
		<?php echo $form->textField($model,'date_create'); ?>
		<?php echo $form->error($model,'date_create'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->