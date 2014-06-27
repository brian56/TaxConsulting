<?php
/* @var $this InfoController */
/* @var $model Info */

$this->breadcrumbs = array (
		// Yii::t('strings','Manager')=>array("/manager"),
		Yii::t ( 'strings', 'Individual Info' ) => array (
				'individualPage' 
		),
		Yii::t ( 'strings', 'Create' ) 
);

$this->menu = array (
		array (
				'label' => Yii::t ( 'strings', 'Manage Individual Info' ),
				'url' => array (
						'individualPage' 
				) 
		),
);
?>

<center>
	<h3><?php echo Yii::t('strings','Create Individual Info');?></h3>
</center>

<?php $this->renderPartial('individualPage_form', array('model'=>$model)); ?>