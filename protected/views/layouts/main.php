<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo">
		<?php 
		if(Yii::app()->user->getState('isManager')) {
			//echo CHtml::encode(Yii::app()->name); 
			echo Yii::app()->user->getState('companyName', '');
		} else {
			echo Yii::app()->name;
		}
		?>
		</div>
	</div><!-- header -->
	<div id="eflat-menu">

	<?php 
	$activedManagerItem = false;
	if(isset(Yii::app()->controller->module->id) && (Yii::app()->controller->module->id=='manager')) {
		$activedManagerItem = true;
	}
	if(isset(Yii::app()->controller->module->parentModule->id) && (Yii::app()->controller->module->parentModule->id=='manager')) {
		$activedManagerItem = true;
	}
	$activedAdminItem = false;
	if(isset(Yii::app()->controller->module->id) && (Yii::app()->controller->module->id=='admin')) {
		$activedAdminItem = true;
	}
	if(isset(Yii::app()->controller->module->parentModule->id) && (Yii::app()->controller->module->parentModule->id=='admin')) {
		$activedAdminItem = true;
	}
		$this->widget('application.extensions.eflatmenu.EFlatMenu', array(
			'items' => array(
				array(
					'label'=>'Home', 
					'url'=>array('/site'),
					'visible' => TRUE, 
					'active'=>(Yii::app()->controller->action->id=='index' && Yii::app()->controller->id=='site')),
				array(
					'label'=>'Manager', 
					'url'=>array('/manager'), 
					'visible' => (!Yii::app()->user->isGuest && Yii::app()->user->getState("isManager")), 
					'active'=>$activedManagerItem,
				),
				array(
					'label'=>'Administrator', 
					'url'=>array('/admin'), 
					'visible' => (!Yii::app()->user->isGuest && Yii::app()->user->getState("isAdmin")) , 
					'active'=>$activedAdminItem,
				),
				array(
					'label' => 'Login', 
					'url' => array('site/login'), 
					'visible' => Yii::app()->user->isGuest, 
					'active'=>(Yii::app()->controller->id=='site' && Yii::app()->controller->action->id=='login')),
				array(
					'label' => 'Logout (' . Yii::app()->user->name . ')', 
					'url' => array('/site/logout'), 
					'visible' => !Yii::app()->user->isGuest)
			)
		));
	?>
	
	</div><!-- mainmenu -->
	
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; 
	?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by Appromobile.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
