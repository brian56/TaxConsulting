<?php
/* @var $this RssNotificationController */
/* @var $model RssNotification */

$this->breadcrumbs=array(
	'Rss Notifications'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List RssNotification', 'url'=>array('index')),
	array('label'=>'Create RssNotification', 'url'=>array('create')),
	array('label'=>'Update RssNotification', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete RssNotification', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RssNotification', 'url'=>array('admin')),
);
?>

<h1>View RssNotification #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'company_id',
		'notify',
		'last_post_pubDate',
		'last_post_title',
		'last_post_url',
		'last_post_author',
	),
)); ?>
