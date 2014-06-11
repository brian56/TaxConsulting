<?php
/* @var $this InfoController */
/* @var $dataProvider CActiveDataProvider */
$this->breadcrumbs=array(
	'Infos',
);

$this->menu=array(
	array('label'=>'Create Info', 'url'=>array('create')),
	array('label'=>'Manage Info', 'url'=>array('admin')),
);
?>

<h4>Infos</h4>

<?php /* $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));  */?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'columns'=>array(
				'id',
				array(
						'name' => 'info_type_id',
						'value' => '$data->infoTypeName',
				),
				array(
						'name' => 'user_id',
						'value' => '$data->infoUserName',
				),
				'title',
				array(
						'name' => 'access_level_id',
						'value' => '$data->infoAccessLevelName',
				)
	),
	'htmlOptions'=>array('style'=>'cursor: pointer;'),
		'selectionChanged'=>'function(id){ location.href = "'.$this->createUrl('view').'?id="+$.fn.yiiGridView.getSelection(id);}',
)); ?>


