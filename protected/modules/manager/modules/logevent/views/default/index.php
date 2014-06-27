<?php
/* @var $this LogEventController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Log Events',
);

?>

<h1>Log Events</h1>
<?php
$this->widget ( 'booster.widgets.TbGridView', array (
		'type' => 'bordered condensed',
		'dataProvider'=>$dataProvider,
		// 'filter'=>$model,
		'emptyText' => Yii::t ( 'strings', 'No results found' ),
		'summaryText' => Yii::t ( 'strings', 'Displaying' ) . ' {start}-{end} ' . Yii::t ( 'strings', 'of' ) . ' {count} ' . Yii::t ( 'strings', 'result(s)' ),
		'columns' => array (
				'id',
				array (
						'name' => 'user_id',
						'value' => '$data->user_email'
				),
				array (
						'name' => 'event_id',
						'value' => '$data->event->name'
				),
				array (
						'name' => 'info_id',
						'value' => '$data->info_title'
				),
				'description',
				'date_create',
				),
				/*
				 'content',
'date_update',
*/
// 				array (
// 						'class' => 'booster.widgets.TbButtonColumn',
// 						'template' => '{view}{update}{delete}',
// 						'htmlOptions' => array (
// 								'style' => 'width:60px;'
// 						),
// 						'buttons' => array (
// 								'delete' => array (
// 										'options' => array (
// 												'style' => 'margin:2px;'
// 										),
// 										'label' => Yii::t ( 'strings', 'Delete' )
// 								),
// 								'view' => array (
// 										'options' => array (
// 												'style' => 'margin:2px;'
// 										),
// 										'label' => Yii::t ( 'strings', 'View' ),
// 										'url' => 'Yii::app()->createUrl("manager/logevent/default/view", array("id"=>$data->id))'
// 								),
// 								'update' => array (
// 										'options' => array (
// 												'style' => 'margin:2px;'
// 										),
// 										'label' => Yii::t ( 'strings', 'Update' ),
// 										'url' => 'Yii::app()->createUrl("manager/logevent/default/update", array("id"=>$data->id))'
// 								)
// 						)
// 				)
// 		),
// 		'htmlOptions' => array (
// 				'style' => 'cursor: pointer;'
// 		),
// 		'selectionChanged' => 'function(id){ location.href = "' . $this->createUrl ( 'view' ) . '?id="+$.fn.yiiGridView.getSelection(id);}',
)); ?>