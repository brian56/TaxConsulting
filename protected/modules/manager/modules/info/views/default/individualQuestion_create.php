<?php
/* @var $this InfoController */
/* @var $model Info */

$this->breadcrumbs=array(
// 		Yii::t('strings','Manager')=>array("/manager"),
	Yii::t('strings','Individual Question')=>array('individualQuestion'),
	Yii::t('strings','Create'),
);

$this->menu=array(
	array('label'=>Yii::t('strings','Manage Individual Question'), 'url'=>array('individualQuestion')),
	array('label'=>Yii::t('strings','Tracking new Individual Question'), 'url'=>array('trackingIndividualQuestion')),
);
?>

<center><h3><?php echo Yii::t('strings','Create Individual Question');?></h3></center>

<?php $this->renderPartial('individualQuestion_form', array('model'=>$model)); ?>