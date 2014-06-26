<?php
/* @var $this InfoController */
/* @var $model Info */

$this->breadcrumbs = array (
		// Yii::t('strings','Manager')=>array("/manager"),
		Yii::t ( 'strings', 'Tax Info' ) => array (
				'taxInfo' 
		),
		$model->title 
);

$this->menu = array (
		array (
				'label' => Yii::t ( 'strings', 'Create Tax Info' ),
				'url' => array (
						'taxInfocreate' 
				) 
		),
		array (
				'label' => Yii::t ( 'strings', 'Update Tax Info' ),
				'url' => array (
						'taxInfoupdate',
						'id' => $model->id 
				) 
		),
		array (
				'label' => Yii::t ( 'strings', 'Delete Tax Info' ),
				'url' => '#',
				'linkOptions' => array (
						'submit' => array (
								'delete',
								'id' => $model->id 
						),
						'params' => array (
								'returnUrl' => 'taxInfo' 
						),
						'confirm' => 'Are you sure you want to delete this item?' 
				) 
		),
		array (
				'label' => Yii::t ( 'strings', 'Manage Tax Info' ),
				'url' => array (
						'taxInfo' 
				) 
		) 
);

?>

<center>
	<h3><?php echo Yii::t('strings','View Tax Info').' #'; echo $model->id; ?></h3>
</center>

<?php

$this->widget ( 'zii.widgets.CDetailView', array (
		'data' => $model,
		'attributes' => array (
				'id',
				array (
						'name' => 'user_id',
						'value' => $model->getInfoUserName () 
				),
				'title',
				array (
						'name' => 'content',
						'type' => 'raw' 
				),
				'date_create',
				'date_update',
				array (
						'name' => 'access_level_id',
						'value' => $model->getInfoAccessLevelName () 
				) 
		) 
) );
?>