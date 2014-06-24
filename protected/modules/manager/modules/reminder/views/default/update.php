<?php
/* @var $this ReminderController */
/* @var $model Reminder */

$this->breadcrumbs=array(
	'Reminders'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Reminder', 'url'=>array('index')),
	array('label'=>'Create Reminder', 'url'=>array('create')),
	array('label'=>'View Reminder', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Reminder', 'url'=>array('admin')),
);
?>

<h1>Update Reminder <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>