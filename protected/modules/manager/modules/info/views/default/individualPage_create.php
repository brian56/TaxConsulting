<?php
/* @var $this InfoController */
/* @var $model Info */

$this->breadcrumbs=array(
// 		Yii::t('strings','Manager')=>array("/manager"),
	Yii::t('strings','Individual Page')=>array('individualPage'),
	Yii::t('strings','Create'),
);

$this->menu=array(
	array('label'=>Yii::t('strings','Manage Individual Page'), 'url'=>array('individualPage')),
	array('label'=>Yii::t('strings','Tracking new Individual Page'), 'url'=>array('trackingIndividualPage')),
);
?>

<center><h3><?php echo Yii::t('strings','Create Individual Page');?></h3></center>

<?php $this->renderPartial('individualPage_form', array('model'=>$model)); ?>