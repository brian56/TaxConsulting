<?php
/* @var $this RssNotificationController */
/* @var $model RssNotification */

$this->breadcrumbs=array(
	'Rss Notifications'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List RssNotification', 'url'=>array('index')),
	array('label'=>'Create RssNotification', 'url'=>array('create')),
	array('label'=>'View RssNotification', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage RssNotification', 'url'=>array('admin')),
);
?>

<h1>Update RssNotification <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>