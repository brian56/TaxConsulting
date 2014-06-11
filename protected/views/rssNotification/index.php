<?php
/* @var $this RssNotificationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Rss Notifications',
);

$this->menu=array(
	array('label'=>'Create RssNotification', 'url'=>array('create')),
	array('label'=>'Manage RssNotification', 'url'=>array('admin')),
);
?>

<h1>Rss Notifications</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
