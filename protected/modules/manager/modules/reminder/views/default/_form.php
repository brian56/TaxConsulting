<?php
/* @var $this ReminderController */
/* @var $model Reminder */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'reminder-form',
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
		<?php echo $form->dropDownList($model, 'user_id', array(Yii::app()->user->getState('userId')=>Yii::app()->user->getState('userName'))); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php echo $form->textField($model,'date', array('readonly'=>true)); ?>
		<?php echo $form->error($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'time'); ?>
		<?php echo $form->textField($model,'time'); ?>
		<?php echo $form->error($model,'time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textArea($model,'title',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="row">
		<?php 
			$arr = User::model()->getArrayCompanyUsers();
		?>
		<?php echo $form->labelEx($model,'user_receive'); ?>
		<?php echo $form->dropDownList($model,'user_receive',$arr); ?>
		<?php echo $form->error($model,'user_receive'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'alarm_setting'); ?>
		<?php echo $form->dropDownList($model, 'alarm_setting', array('1'=>Yii::t('strings','Yes'), '0'=>Yii::t('strings','No'))); ?>
		<?php echo $form->error($model,'alarm_setting'); ?>
	</div>

	<div class="row">
		<?php 
			$arr = array(
				'3' => '3 hours',
				'5' => '5 hours',
				'24' => '1 day',
				'72' => '3 days',
			); 
		?>
		<?php echo $form->labelEx($model,'alarm_time'); ?>
		<?php echo $form->dropDownList($model,'alarm_time',$arr); ?>
		<?php echo $form->error($model,'alarm_time'); ?>
	</div>

	<div class="row buttons">
		<?php 
		$this->widget(
				'booster.widgets.TbButton',
				array(
						'label' => $model->isNewRecord ? Yii::t('strings','Create') : Yii::t('strings','Save'),
						'context' => 'primary',
						'buttonType' => 'submit',
				)
		);?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->