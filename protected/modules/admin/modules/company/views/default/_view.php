<?php
/* @var $this CompanyController */
/* @var $data Company */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_actived')); ?>:</b>
	<?php echo CHtml::encode($data->is_actived); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name_en')); ?>:</b>
	<?php echo CHtml::encode($data->name_en); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rss_url')); ?>:</b>
	<?php echo CHtml::encode($data->rss_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('introduction')); ?>:</b>
	<?php echo CHtml::encode($data->introduction); ?>
	<br />


</div>