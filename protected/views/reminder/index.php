<?php
/* @var $this ReminderController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Reminders',
);

$this->menu=array(
	array('label'=>'Create Reminder', 'url'=>array('create')),
	array('label'=>'Manage Reminder', 'url'=>array('admin')),
);
?>

<h1>Reminders</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
