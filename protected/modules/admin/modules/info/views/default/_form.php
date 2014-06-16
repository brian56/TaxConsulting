<?php
/* @var $this InfoController */
/* @var $model Info */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'info-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div class="span-10">
		<?php echo $form->labelEx($model,'info_type_id'); ?>
		<?php echo $form->dropDownList($model, 'info_type_id', CHtml::listData(InfoType::model()->findAll(), 'id', 'name')); ?>
		<?php echo $form->error($model,'info_type_id'); ?>
		</div>
	
		<div class="span-10">
		<?php echo $form->labelEx($model,'company_id'); ?>
		<?php echo $form->dropDownList(
			$model, 
			'company_id', 
			CHtml::listData(Company::model()->findAll(), 'id', 'name'),
			array(
				'prompt' => '- Select company -',
				'ajax' => array(
					'type'=>'POST', //request type
					'url'=>CController::createUrl('default/ajaxLoadUser'), //url to call.
					//Style: CController::createUrl('currentController/methodToCall')
					'update'=>'#Info_user_id', //selector to update
					//'data'=>array('company_id' => 'js:this.value')
					//leave out the data key to pass all form values through
			))); ?>
		<?php echo $form->error($model,'company_id'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span-10">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'title'); ?>
		</div>
		
		<div class="span-10">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->dropDownList($model,'user_id', array('promt'=>'Please select company first!')); ?>
		<?php echo $form->error($model,'user_id'); ?>
		</div>
	</div>

	<div class="row">
		<div class="span-10">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('rows'=>3, 'cols'=>57)); ?>
		<?php echo $form->error($model,'content'); ?>
		</div>
	
		<div class="span-10">
		<?php echo $form->labelEx($model,'appointment_status'); ?>
		<?php echo $form->dropDownList($model,'appointment_status',array('0'=>'Pending', '1'=>'Confirmed', '-1'=>'Refused')); ?>
		<?php echo $form->error($model,'appointment_status'); ?>
		</div>
	</div>
	
	<div class="row">
		<div class="span-10">
		<?php echo $form->labelEx($model,'appointment_date'); ?>
		<?php echo $form->textField($model,'appointment_date',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'appointment_date'); ?>
		</div>
	
		<div class="span-10">
		<?php echo $form->labelEx($model,'access_level_id'); ?>
		<?php echo $form->dropDownList($model, 'access_level_id', CHtml::listData(AccessLevel::model()->findAll(), 'id', 'name')); ?>
		<?php echo $form->error($model,'access_level_id'); ?>
		</div>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->