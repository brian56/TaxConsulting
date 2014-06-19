<?php
/* @var $this InfoController */
/* @var $model Info */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#info-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php
/* @var $this InfoController */
/* @var $model Info */

$this->breadcrumbs=array(
// 		Yii::t('strings','Manager')=>array("/manager"),
		Yii::t('strings','Notice'),
);
	$this->menu=array(
			array('label'=>Yii::t('strings','Create Notice'), 'url'=>array('noticeCreate')),

	);

?>
<center><h3><?php echo Yii::t('strings','Manage Notice');?></h3></center>
<p>
<?php 
echo Yii::t('strings', 'You may optionally enter a comparison operator (<, <=, >, >=, <> or =) at the beginning of each of your search values to specify how the comparison should be done.');
?>
</p>

<?php echo CHtml::link(Yii::t('strings','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'info-grid',
	'dataProvider'=>$model->searchNotice(Yii::app()->user->getState('globalId')),
	//'filter'=>$model,
'emptyText' => Yii::t('strings','No results found'),
'summaryText' => Yii::t('strings','Displaying').' {start}-{end} '.Yii::t('strings','of').' {count} '.Yii::t('strings','result(s)'),
	'columns'=>array(
		'id',
		array(
				'name' => 'user_id',
				'value' => '$data->infoUserName',
		),
		'title',
		array(
				'name' => 'access_level_id',
				'value' => '$data->infoAccessLevelName',
		),
		'date_create',
		/*
		'content',
		'date_update',
		*/
		array(
		'class'=>'CButtonColumn',
		'template'=>'{view}{update}{delete}',
		'buttons'=>array
		(
				'delete' => array
				(
					'label' => Yii::t('strings','Delete'),
				),
				'view' => array
				(
					'label' => Yii::t('strings','View'),
						'url'=> 'Yii::app()->createUrl("manager/info/default/noticeView", array("id"=>$data->id))',
				),
				'update' => array
				(
					'label' => Yii::t('strings','Update'),
						'url'=> 'Yii::app()->createUrl("manager/info/default/noticeUpdate", array("id"=>$data->id))',
				),
		),
),
	),
	'htmlOptions'=>array('style'=>'cursor: pointer;'),
		'selectionChanged'=>'function(id){ location.href = "'.$this->createUrl('noticeview').'?id="+$.fn.yiiGridView.getSelection(id);}',
)); ?>
