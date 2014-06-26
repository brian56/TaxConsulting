<?php
$this->widget ( 'booster.widgets.TbGridView', array (
		// 'id'=>'info-grid',
		'type' => 'bordered condensed',
		'dataProvider' => $model->searchIndividualPage ( Yii::app ()->user->getState ( 'globalId' ) ),
		// 'filter'=>$model,
		'emptyText' => Yii::t ( 'strings', 'No results found' ),
		'summaryText' => Yii::t ( 'strings', 'Displaying' ) . ' {start}-{end} ' . Yii::t ( 'strings', 'of' ) . ' {count} ' . Yii::t ( 'strings', 'result(s)' ),
		'columns' => array (
				'id',
				array (
						'name' => 'user_id',
						'value' => '$data->infoUserName' 
				),
				'title',
				array (
						'name' => 'receiver_id',
						'value' => '$data->receiverName' 
				),
				'date_create',
		/*
		'content',
		'appointment_date',
		'date_update',
		*/
				array (
						'class' => 'booster.widgets.TbButtonColumn',
						'template' => '{view}{update}{delete}',
						'htmlOptions' => array (
								'style' => 'width:60px;' 
						),
						'buttons' => array (
								'delete' => array (
										'options' => array (
												'style' => 'margin:2px;' 
										),
										'label' => Yii::t ( 'strings', 'Delete' ) 
								),
								'view' => array (
										'options' => array (
												'style' => 'margin:2px;' 
										),
										'label' => Yii::t ( 'strings', 'View' ),
										'url' => 'Yii::app()->createUrl("manager/info/default/individualPageView", array("id"=>$data->id))' 
								),
								'update' => array (
										'options' => array (
												'style' => 'margin:2px;' 
										),
										'url' => 'Yii::app()->createUrl("manager/info/default/individualPageUpdate", array("id"=>$data->id))' 
								) 
						) 
				) 
		),
		'htmlOptions' => array (
				'style' => 'cursor: pointer;' 
		),
		'selectionChanged' => 'function(id){ location.href = "' . $this->createUrl ( 'individualPageView' ) . '?id="+$.fn.yiiGridView.getSelection(id);}' 
) );
?>
		