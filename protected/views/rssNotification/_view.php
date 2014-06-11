<?php
/* @var $this RssNotificationController */
/* @var $data RssNotification */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('company_id')); ?>:</b>
	<?php echo CHtml::encode($data->company_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notify')); ?>:</b>
	<?php echo CHtml::encode($data->notify); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_post_pubDate')); ?>:</b>
	<?php echo CHtml::encode($data->last_post_pubDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_post_title')); ?>:</b>
	<?php echo CHtml::encode($data->last_post_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_post_url')); ?>:</b>
	<?php echo CHtml::encode($data->last_post_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_post_author')); ?>:</b>
	<?php echo CHtml::encode($data->last_post_author); ?>
	<br />


</div>