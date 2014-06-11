<?php
/* @var $this RssNotificationController */
/* @var $model RssNotification */

$this->breadcrumbs=array(
	'Rss Notifications'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List RssNotification', 'url'=>array('index')),
	array('label'=>'Manage RssNotification', 'url'=>array('admin')),
);
?>

<h1>Create RssNotification</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>