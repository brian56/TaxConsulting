<?php 
 $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'info-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		'id',
		array(
			'name' => 'info_type_id',
			'value' => '$data->infoType->name',
		),
		array(
			'name' => 'user_id',
			'value' => '$data->user->email',
		),
		array(
			'name' => 'company_id',
			'value' => '$data->company->name',
		),
		'title',
		array(
			'name' => 'access_level_id',
			'value' => '$data->accessLevel->name',
		),
		/*
		'content',
		'appointment_date',
		'date_create',
		'date_update',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>