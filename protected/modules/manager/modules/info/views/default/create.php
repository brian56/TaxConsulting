<?php
/* @var $this InfoController */
/* @var $model Info */
$this->breadcrumbs=array(
	'Infos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Info', 'url'=>array('index')),
	array('label'=>'Manage Info', 'url'=>array('admin')),
);
?>

<h4>Create Info</h4>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>