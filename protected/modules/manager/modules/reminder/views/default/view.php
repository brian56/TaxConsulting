<?php
/* @var $this ReminderController */
/* @var $model Reminder */

$this->breadcrumbs=array(
	'Reminders'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Reminder', 'url'=>array('index')),
	array('label'=>'Create Reminder', 'url'=>array('create')),
	array('label'=>'Update Reminder', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Reminder', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Reminder', 'url'=>array('admin')),
);
?>

<h1>View Reminder #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'company_id',
		'user_id',
		'date',
		'time',
		'title',
		'content',
		'user_receive',
		'alarm_setting',
		'alarm_time',
	),
)); ?>
