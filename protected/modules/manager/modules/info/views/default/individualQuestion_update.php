<?php
/* @var $this InfoController */
/* @var $model Info */

$this->breadcrumbs=array(
// 		Yii::t('strings','Manager')=>array("/manager"),
	Yii::t('strings','Individual Question')=>array('individualQuestion'),
	$model->title=>array('individualQuestionView','id'=>$model->id),
	Yii::t('strings','Update'),
);

	$this->menu=array(
			array('label'=>Yii::t('strings','Create Individual Question'), 'url'=>array('individualQuestioncreate')),
			array('label'=>Yii::t('strings','View Individual Question'), 'url'=>array('individualQuestionview', 'id'=>$model->id)),
			array('label'=>Yii::t('strings','Delete Individual Question'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id), 'params' => array('returnUrl'=>'question'),'confirm'=>'Are you sure you want to delete this item?')),
			array('label'=>Yii::t('strings','Manage Individual Question'), 'url'=>array('individualQuestion')),
			array('label'=>Yii::t('strings','Tracking new Individual Question'), 'url'=>array('trackingIndividualQuestion')),
	);
?>

<center><h3><?php echo Yii::t('strings','Update Individual Question').' #'; echo $model->id; ?></h3></center>

<?php $this->renderPartial('individualQuestion_formUpdate', array('model'=>$model)); ?>