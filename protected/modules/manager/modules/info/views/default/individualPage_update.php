<?php
/* @var $this InfoController */
/* @var $model Info */

$this->breadcrumbs = array (
		// Yii::t('strings','Manager')=>array("/manager"),
		Yii::t ( 'strings', 'Individual Page' ) => array (
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
				'label' => Yii::t ( 'strings', 'Create Individual Page' ),
				'url' => array (
						'individualPagecreate' 
				) 
		),
		array (
				'label' => Yii::t ( 'strings', 'View Individual Page' ),
				'url' => array (
						'individualPageview',
						'id' => $model->id 
				) 
		),
		array (
				'label' => Yii::t ( 'strings', 'Delete Individual Page' ),
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
				'label' => Yii::t ( 'strings', 'Manage Individual Page' ),
				'url' => array (
						'individualPage' 
				) 
		),
		array (
				'label' => Yii::t ( 'strings', 'Tracking new Individual Page' ),
				'url' => array (
						'trackingIndividualPage' 
				) 
		) 
);
?>

<center>
	<h3><?php echo Yii::t('strings','Update Individual Page').' #'; echo $model->id; ?></h3>
</center>

<?php $this->renderPartial('individualPage_formUpdate', array('model'=>$model)); ?>