<?php
/* @var $this CompanyController */
/* @var $model Company */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<div class="span-10">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
		</div>

		<div class="span-10">
		<?php echo $form->label($model,'is_actived'); ?>
		<?php echo $form->dropDownList($model, 'is_actived', array('1'=>'Actived', '0'=>'Inactived')); ?>
		</div>
	</div>

	<div class="row">
		<div class="span-10">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name'); ?>
		</div>

		<div class="span-10">
		<?php echo $form->label($model,'name_en'); ?>
		<?php echo $form->textField($model,'name_en'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span-10">
		<?php echo $form->label($model,'introduction'); ?>
		<?php echo $form->textField($model,'introduction'); ?>
		</div>

		<div class="span-10">
		<?php echo $form->label($model,'photos'); ?>
		<?php echo $form->textField($model,'photos'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span-10">
			<?php echo $form->label($model,'rss_url'); ?>
			<?php echo $form->textField($model,'rss_url'); ?>
		</div>
		<div class="span-10">
		<?php echo $form->label($model,'location'); ?>
		<?php echo $form->textField($model,'location'); ?>
		</div>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->