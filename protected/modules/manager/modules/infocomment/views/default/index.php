<?php
/* @var $this InfoCommentController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Info Comments',
);

$this->menu=array(
	array('label'=>'Create InfoComment', 'url'=>array('create')),
	array('label'=>'Manage InfoComment', 'url'=>array('admin')),
);
?>

<h1>Info Comments</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'htmlOptions'=>array('style'=>'cursor: pointer;'),
	'selectionChanged'=>'function(id){ location.href = "'.$this->createUrl('view').'/id/"+$.fn.yiiGridView.getSelection(id);}',
)); ?>

<?php
/* $this->widget ( 'zii.widgets.CListView', array (
		'dataProvider' => $dataProvider,
		'itemView' => '_view' 
) ); */
echo "<pre>";
$now = date('Y-m-d H:i:s');
			$tomorrow = strtotime("+1 day", strtotime($now));
			$token_expired_date = date('Y-m-d H:i:s', $tomorrow);
			print_r($token_expired_date);
echo "</pre>";
?>
