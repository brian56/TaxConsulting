<?php
/* @var $this InfoController */
/* @var $model Info */

$this->breadcrumbs = array (
		// Yii::t('strings','Manager')=>array("/manager"),
		Yii::t ( 'strings', 'Individual Info' ) => array (
				'individualPage' 
		),
		$model->title => array (
				'individualPageView',
				'id' => $model->id 
		),
		Yii::t ( 'strings', 'Update' ) 
);

$this->menu = array (
		array (
				'label' => Yii::t ( 'strings', 'Create Individual Info' ),
				'url' => array (
						'individualPagecreate' 
				) 
		),
		array (
				'label' => Yii::t ( 'strings', 'View Individual Info' ),
				'url' => array (
						'individualPageview',
						'id' => $model->id 
				) 
		),
		array (
				'label' => Yii::t ( 'strings', 'Delete Individual Info' ),
				'url' => '#',
				'linkOptions' => array (
						'submit' => array (
								'delete',
								'id' => $model->id 
						),
						'params' => array (
								'returnUrl' => 'question' 
						),
						'confirm' => 'Are you sure you want to delete this item?' 
				) 
		),
		array (
				'label' => Yii::t ( 'strings', 'Manage Individual Info' ),
				'url' => array (
						'individualPage' 
				) 
		),
);
?>

<center>
	<h3><?php echo Yii::t('strings','Update Individual Info').' #'; echo $model->id; ?></h3>
</center>

<?php $this->renderPartial('individualPage_formUpdate', array('model'=>$model)); ?>