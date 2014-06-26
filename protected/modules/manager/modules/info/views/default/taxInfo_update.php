<?php
/* @var $this InfoController */
/* @var $model Info */

$this->breadcrumbs = array (
		// Yii::t('strings','Manager')=>array("/manager"),
		Yii::t ( 'strings', 'Tax Info' ) => array (
				'taxInfo' 
		),
		$model->title => array (
				'taxInfoView',
				'id' => $model->id 
		),
		Yii::t ( 'strings', 'Update' ) 
);

$this->menu = array (
		array (
				'label' => Yii::t ( 'strings', 'Create Tax Info' ),
				'url' => array (
						'taxInfocreate' 
				) 
		),
		array (
				'label' => Yii::t ( 'strings', 'View Tax Info' ),
				'url' => array (
						'taxInfoview',
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
	<h3><?php echo Yii::t('strings','Update Tax Info').' #'; echo $model->id; ?></h3>
</center>

<?php $this->renderPartial('taxInfo_formUpdate', array('model'=>$model)); ?>