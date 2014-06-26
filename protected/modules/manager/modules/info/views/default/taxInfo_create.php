<?php
/* @var $this InfoController */
/* @var $model Info */

$this->breadcrumbs = array (
		// Yii::t('strings','Manager')=>array("/manager"),
		Yii::t ( 'strings', 'Tax Info' ) => array (
				'taxInfo' 
		),
		Yii::t ( 'strings', 'Create' ) 
);

$this->menu = array (
		array (
				'label' => Yii::t ( 'strings', 'Manage Tax Info' ),
				'url' => array (
						'taxInfo' 
				) 
		) 
);
?>

<center>
	<h3><?php echo Yii::t('strings','Create Tax Info');?></h3>
</center>

<?php $this->renderPartial('taxInfo_form', array('model'=>$model)); ?>