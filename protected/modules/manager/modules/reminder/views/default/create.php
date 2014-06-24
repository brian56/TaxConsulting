<?php
/* @var $this ReminderController */
/* @var $model Reminder */

$this->breadcrumbs=array(
	'Reminders'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Reminder', 'url'=>array('index')),
	array('label'=>'Manage Reminder', 'url'=>array('admin')),
);
?>

<h1>Create Reminder</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>