<?php
/* @var $this UserController */
/* @var $model User */

	
$this->breadcrumbs=array(
	'Advance Manage'=> array('/manager/info/default/advancemanage'),
	'Manage User',
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Tracking New User', 'url'=>array('trackingUser')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<center><h3>Manage Users</h3></center>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php $this->widget('booster.widgets.TbGridView', array(
	'id'=>'user-grid',
	'type'=>'bordered condensed',
	'dataProvider'=>$model->getCompanyUsers(),
	//'filter'=>$model,
	'columns'=>array(
		'id',
		array(
			'name' => 'user_level_id',
			'value' => '$data->userLevelName',
		),
		array(
			'name' => 'is_actived',
			'value' => '$data->isActived',
		),
		array(
			'name' => 'notify',
			'value' => '$data->notifyName',
		),
		'email',
		'user_name',
		'register_date',
		/*'contact_phone',
		'device_os_id',
		'password',
		'device_id',
		'token',
		'token_expired_date',
		*/
		array(
		'class'=>'booster.widgets.TbButtonColumn',
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
				),
				'update' => array
				(
					'label' => Yii::t('strings','Update'),
				),
			),
		),
	),
	'htmlOptions'=>array('style'=>'cursor: pointer;'),
		'selectionChanged'=>'function(id){ location.href = "'.$this->createUrl('view').'?id="+$.fn.yiiGridView.getSelection(id);}',
)); 
?>

