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
		'Manager'=>array("/manager"),
		'Tracking Question',
);
	$this->menu=array(
			array('label'=>'Create Question', 'url'=>array('questionCreate')),
			array('label'=>'Manage Questions', 'url'=>array('question')),

	);

?>
<center><h3>Tracking new questions</h3></center>
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
				'view' => array
				(
						'url'=> 'Yii::app()->createUrl("manager/info/default/questionView", array("id"=>$data->id))',
				),
				'update' => array
				(
						'url'=> 'Yii::app()->createUrl("manager/info/default/questionUpdate", array("id"=>$data->id))',
				),
		),
	),
	),
	'htmlOptions'=>array('style'=>'cursor: pointer;'),
		'selectionChanged'=>'function(id){ location.href = "'.$this->createUrl('questionview').'?id="+$.fn.yiiGridView.getSelection(id);}',
)); ?>
</div>