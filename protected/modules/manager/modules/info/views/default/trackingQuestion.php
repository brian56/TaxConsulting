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
		Yii::t('strings','Tracking new Question'),
);
	$this->menu=array(
			array('label'=>Yii::t('strings','Create Question'), 'url'=>array('questionCreate')),
			array('label'=>Yii::t('strings','Manage Question'), 'url'=>array('question')),

	);

?>
<center><h3><?php echo Yii::t('strings','Tracking new Question');?></h3></center>
<script type="text/javascript">
    timeout = 3000;
    function refresh() {       
        <?php
        echo CHtml::ajax(array(
                'url'=> Yii::app()->baseUrl."/manager/info/default/AjaxQuestion",
                'type'=>'post',
                'update'=> '#info-grid',
        ))
        ?>
    }
    window.setInterval("refresh()", timeout);
</script>


<div id='info-grid'>
<?php 
$this->widget('zii.widgets.grid.CGridView', array(
	//'id'=>'info-grid',
	'dataProvider'=>$model->searchQuestion(Yii::app()->user->getState('globalId')),
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
		'appointment_date',
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
						'url'=> 'Yii::app()->createUrl("manager/info/default/questionView", array("id"=>$data->id))',
				),
				'update' => array
				(
						'label' => Yii::t('strings','Update'),
						'url'=> 'Yii::app()->createUrl("manager/info/default/questionUpdate", array("id"=>$data->id))',
				),
		),
	),
	),
	'htmlOptions'=>array('style'=>'cursor: pointer;'),
		'selectionChanged'=>'function(id){ location.href = "'.$this->createUrl('questionview').'?id="+$.fn.yiiGridView.getSelection(id);}',
)); ?>
</div>
