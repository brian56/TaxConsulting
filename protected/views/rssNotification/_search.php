<?php
/* @var $this RssNotificationController */
/* @var $model RssNotification */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'company_id'); ?>
		<?php echo $form->textField($model,'company_id',array('size'=>11,'maxlength'=>11)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'notify'); ?>
		<?php echo $form->textField($model,'notify'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'last_post_pubDate'); ?>
		<?php echo $form->textField($model,'last_post_pubDate',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'last_post_title'); ?>
		<?php echo $form->textArea($model,'last_post_title',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'last_post_url'); ?>
		<?php echo $form->textArea($model,'last_post_url',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'last_post_author'); ?>
		<?php echo $form->textField($model,'last_post_author'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->