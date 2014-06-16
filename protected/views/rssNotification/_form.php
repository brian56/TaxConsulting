<?php
/* @var $this RssNotificationController */
/* @var $model RssNotification */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'rss-notification-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'company_id'); ?>
		<?php echo $form->textField($model,'company_id',array('size'=>11,'maxlength'=>11)); ?>
		<?php echo $form->error($model,'company_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'notify'); ?>
		<?php echo $form->textField($model,'notify'); ?>
		<?php echo $form->error($model,'notify'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_post_pubDate'); ?>
		<?php echo $form->textField($model,'last_post_pubDate',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'last_post_pubDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_post_title'); ?>
		<?php echo $form->textArea($model,'last_post_title',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'last_post_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_post_url'); ?>
		<?php echo $form->textArea($model,'last_post_url',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'last_post_url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_post_author'); ?>
		<?php echo $form->textField($model,'last_post_author'); ?>
		<?php echo $form->error($model,'last_post_author'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->